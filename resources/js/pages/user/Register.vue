<template>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <AppTitlePages
            :icon="UsersIcon"
            title="Usuário"
            label="Preencha os campos a seguir para criar um novo usuário"
        />

        <Form
            @submit="onSubmit"
            :validation-schema="RegisterSchema"
            v-slot="{ errors }"
        >
            <AppFormTemplate>
                <div class="sm:col-span-4">
                    <div class="mt-2">
                        <AppInputText
                            label="Nome"
                            v-model="name"
                            type="text"
                            name="name"
                            id="name"
                            :error="errors.name"
                        />
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <div class="mt-2">
                        <AppInputText
                            label="CPF"
                            v-model="cpf"
                            type="text"
                            name="cpf"
                            id="cpf"
                            :mask="maskedCpf"
                            :error="errors.cpf"
                        />
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <div class="mt-2">
                        <AppInputText
                            label="E-mail"
                            v-model="email"
                            type="text"
                            name="email"
                            id="email"
                            :error="errors.email"
                        />
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <div class="mt-2">
                        <AppComboBoxRole
                            label="Permissão"
                            v-model="role"
                            name="role"
                            id="role"
                            :error="errors.role"
                        ></AppComboBoxRole>
                    </div>
                </div>
            </AppFormTemplate>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button
                    type="reset"
                    class="text-sm font-semibold leading-6 text-gray-900"
                >
                    Cancelar
                </button>
                <button
                    type="submit"
                    class="rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-light"
                >
                    Salvar
                </button>
            </div>
        </Form>
    </div>
</template>

<script setup>
import { ref, watch } from "vue";
import { Form } from "vee-validate";
import { UsersIcon } from "@heroicons/vue/24/outline";
import { Mask } from "maska";
import Loading from "../../../../store/Loading";
import AppTitlePages from "../../../../components/AppTitlePages.vue";
import AppComboBoxRole from "../../../../components/ComboBox/AppComboBoxRole.vue";
import AppInputText from "@/components/AppInputText.vue";
import AppFormTemplate from "@/components/AppFormTemplate.vue";
import axiosClient from "@/plugins/axios";
import RegisterSchema from "./RegisterAdminYup";
import router from "../../../../router";
import { RoleEnum } from "../../../../helpers/RoleEnum";

const name = ref("");
const cpf = ref("");
const email = ref("");
const role = ref(null);

const errorMessage = ref([]);
const maskedCpf = "###.###.###-##";

const onSubmit = () => {
    Loading.state.loading = true;

    const MaskedCpf = new Mask({ mask: maskedCpf });

    const formData = new FormData();
    formData.append("name", name.value);
    formData.append("cpf", MaskedCpf.unmasked(cpf.value));
    formData.append("email", email.value);

    if (role.value?.id !== undefined) formData.append("role", role.value?.id);

    axiosClient
        .post(`/User/Register`, formData)
        .then(({ data }) => {
            router.push(`/usuario/listar?cpf=${MaskedCpf.unmasked(cpf.value)}`);
        })
        .catch((error) => {
            errorMessage.value = error.response.data.errors;
        })
        .finally(() => {
            Loading.state.loading = false;
        });
};
</script>
