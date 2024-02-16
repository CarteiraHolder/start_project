<template>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <AppTitlePages
            :icon="UsersIcon"
            title="Usuário"
            label="Preencha os filtros para buscar o usuário desejado"
            @exportExcel="exportExcel"
            :exportExcelShow="true"
        />
        <div class="mt-8">
            <div class="grid grid-cols-1 gap-x-6 gap-y-2 sm:grid-cols-12">
                <div class="sm:col-span-3 sm:mt-0 mt-2">
                    <AppInputText
                        v-model="name"
                        type="text"
                        name="name"
                        label="Name"
                        id="name"
                    />
                </div>

                <div class="sm:col-span-3 sm:mt-0 mt-2">
                    <AppInputText
                        type="text"
                        name="cpf"
                        label="CPF"
                        id="cpf"
                        v-model="cpf"
                    />
                </div>
                <div class="sm:col-span-3 sm:mt-0 mt-2">
                    <AppInputText
                        type="text"
                        name="email"
                        label="E-mail"
                        id="email"
                        v-model="email"
                    />
                </div>
                <div class="sm:col-span-3 sm:mt-0 mt-2">
                    <AppComboBoxRole
                        name="role"
                        label="Permissão"
                        id="role"
                        :allPermissions="true"
                        v-model="role"
                    />
                </div>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <EasyDataTable
                table-class-name="customize-table"
                :theme-color="'#1d548d'"
                :headers="headers"
                :items="items"
                buttons-pagination
                :loading="loading"
                rows-of-page-separator-message="de"
                hide-rows-per-page
                v-model:server-options="serverOptions"
                :server-items-length="serverItemsLength"
                empty-message="Nenhum registro encontrado"
            >
                <template #item-name="{ cpf, profile_photo, name, email }">
                    <div class="py-2">
                        <div class="flex items-center">
                            <div class="h-13 w-13 flex-shrink-0">
                                <img
                                    class="h-12 w-12 rounded-full"
                                    :src="
                                        profile_photo ??
                                        '/assets/images/profile-picture.jpeg'
                                    "
                                    alt=""
                                />
                            </div>
                            <div class="ml-4">
                                <div class="font-medium text-gray-900">
                                    {{ name }}
                                </div>
                                <div class="text-gray-500">
                                    {{ cpf ? maskedCpf.masked(cpf) : "" }}
                                </div>
                                <div class="text-gray-500">
                                    {{ email }}
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <template #item-role.role="{ role }">
                    <AppBadgesRoles :role="role?.role"> </AppBadgesRoles>
                </template>
                <template #item-created_at="{ created_at }">
                    <div>
                        {{ new Date(created_at).toLocaleDateString("pt-BR") }}
                    </div>
                    <div>
                        {{ new Date(created_at).toLocaleTimeString("pt-BR") }}
                    </div>
                </template>
                <template #item-status="{ id, name }">
                    <AppSwitchConfirm
                        @changeChecked="changeActive(id)"
                        :label="`O usuário ${name} será ${
                            enabled[id] ? 'desativado' : 'ativado'
                        }`"
                        :isChecked="enabled[id]"
                    />
                </template>

                <template #item-actions="{ id, role }">
                    <div class="flex flex-row">
                        <button
                            v-if="storeUser.state.user.role == RoleEnum.admin"
                            @click="loginBecome(id)"
                        >
                            <ArrowsRightLeftIcon
                                v-tippy="'Login Become'"
                                class="text-white bg-amber-500 p-1 rounded w-6 h-6 mr-1"
                            ></ArrowsRightLeftIcon>
                        </button>

                        <router-link :to="`/usuario/atualizar/${id}`">
                            <PencilSquareIcon
                                v-tippy="'Editar'"
                                class="text-white bg-primary-light p-1 rounded w-6 h-6 mr-1"
                            ></PencilSquareIcon>
                        </router-link>
                    </div>
                </template>
            </EasyDataTable>
        </div>
    </div>
</template>

<script setup>
import { computed, onBeforeMount, ref, watch } from "vue";
import {
    UsersIcon,
    PencilSquareIcon,
    CheckIcon,
    XMarkIcon,
    ArrowsRightLeftIcon,
} from "@heroicons/vue/24/outline";
import {
    headers,
    items,
    loading,
    serverOptions,
    serverItemsLength,
} from "../../plugins/EasyDataTable";
import { TimeoutHelper } from "../../helpers/Timeout";
import {
    download,
    headers as downloadHeaders,
} from "../../helpers/DownloadExcel";
import { toast } from "vue3-toastify";
import { Mask } from "maska";
import AppTitlePages from "../../components/AppTitlePages.vue";
import AppInputText from "../.././components/AppInputText.vue";
import AppSwitchConfirm from "../../components/AppSwitchConfirm.vue";
import AppBadgesRoles from "../../components/AppBadgesRoles.vue";
import AppComboBoxRole from "../../components/ComboBox/AppComboBoxRole.vue";
import axiosClient from "../../plugins/axios";
import router from "../../router";
import storeUser from "../../store/User";
import { RoleEnum } from "../../helpers/RoleEnum";

const maskedCpf = new Mask({ mask: "###.###.###-##" });
const maskedCnpj = new Mask({ mask: "##.###.###/####-##" });

onBeforeMount(() => {
    items.value = [];

    if (router.currentRoute.value.query.cpf != undefined)
        cpf.value = router.currentRoute.value.query.cpf;

    serverOptions.value.sortBy = "name";
    getList();
});

headers.value = [
    { text: "Nome", value: "name", sortable: true },
    { text: "Permissão", value: "role.role", sortable: true },
    { text: "Data de Criação", value: "created_at", sortable: true },
    { text: "Ativo", value: "status" },
    { text: "Ações", value: "actions" },
];

const name = ref("");
const cpf = ref("");
const email = ref("");
const role = ref(null);
const data = ref("");
const enabled = ref([]);

const getList = () => {
    loading.value = true;
    axiosClient
        .post("User/List", formData.value)
        .then(({ data }) => {
            items.value = data.list.data;
            serverItemsLength.value = data.list.total;

            items.value.forEach((element) => {
                enabled.value[element.id] = element.active;
            });
        })
        .finally(() => (loading.value = false));
};

const exportExcel = () => {
    loading.value = true;

    axiosClient
        .post("User/Export", formData.value)
        .then(({ data }) =>
            toast.success(data.message, {
                transition: toast.TRANSITIONS.BOUNCE,
                dangerouslyHTMLString: true,
            })
        )
        .finally(() => (loading.value = false));
};

const changeActive = (id) => {
    loading.value = true;

    axiosClient
        .get(`User/Status/Change/${id}`)
        .then(({ data }) => {
            enabled.value[id] = !enabled.value[id];
            toast.success(data.message, {
                transition: toast.TRANSITIONS.BOUNCE,
                dangerouslyHTMLString: true,
            });
        })
        .finally(() => (loading.value = false));
};

const formData = computed(() => {
    const formData = new FormData();
    // Pagination
    formData.append("page", serverOptions.value.page);
    formData.append("rowsPerPage", serverOptions.value.rowsPerPage);
    formData.append("sortBy", serverOptions.value.sortBy);
    formData.append("sortType", serverOptions.value.sortType);

    // filters
    formData.append("name", name.value);
    formData.append("cpf", cpf.value);
    formData.append("email", email.value);

    if (role.value?.id !== undefined) formData.append("role", role.value?.id);

    return formData;
});

const loginBecome = (id) => {
    loading.value = true;

    axiosClient
        .get(`User/Login/Become/${id}`)
        .then(({ data }) => {
            localStorage.token = data.token;
            window.location.reload();
        })
        .finally(() => (loading.value = false));
};

watch([serverOptions, name, cpf, email, role, data], (value) =>
    TimeoutHelper(getList, 500)
);
</script>

<style></style>
