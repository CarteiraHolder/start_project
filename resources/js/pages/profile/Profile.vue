<template>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <AppTitlePages
            :icon="UserCircleIcon"
            title="Meu Cadastro"
            label="Preencha os campos a seguir para atualizar seus dados."
        />
        <Form
            @submit="onSubmit"
            :validation-schema="ProfileYup"
            v-slot="{ errors }"
        >
            <AppFormTemplate :isSlideOver="true">
                <div class="grid grid-cols-2 gap-x-6 mb-4">
                    <div class="col-span-full flex items-center gap-x-8">
                        <img
                            :src="img.dataURL"
                            alt=""
                            class="h-24 w-24 flex-none rounded-lg bg-gray-800 object-cover"
                        />
                        <div>
                            <!-- <AppButton type="button"> Trocar foto </AppButton> -->
                            <AppCropper
                                v-model="img"
                                buttonName="Trocar foto"
                            />
                            <p class="mt-2 text-xs leading-5 text-gray-400">
                                JPG, GIF or PNG. 1MB max.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-full col-span-2">
                    <div class="mt-2">
                        <AppInputText
                            id="name"
                            name="name"
                            v-model="UserStore.state.user.fullName"
                            label="Nome"
                            type="text"
                            class-name="lg:w-2/4"
                            :error="errors.name"
                        />
                    </div>
                </div>

                <div class="sm:col-span-1 col-span-2">
                    <div class="mt-2">
                        <AppInputText
                            id="email"
                            name="email"
                            v-model="UserStore.state.user.email"
                            label="E-mail"
                            type="text"
                            class-name="lg:w-2/4"
                            :disabled="true"
                            :readonly="true"
                            v-tippy="{
                                content:
                                    'Entre em contato com suporte para trocar seu e-mail',
                                placement: 'top-start',
                                arrow: false,
                            }"
                        />
                    </div>
                </div>

                <div class="sm:col-span-1 col-span-2">
                    <div class="mt-2">
                        <AppInputText
                            id="cpf"
                            name="cpf"
                            v-model="UserStore.state.user.cpf"
                            :mask="maskedCpf"
                            label="CPF"
                            type="text"
                            class-name="lg:w-2/4"
                            :disabled="true"
                            :readonly="true"
                            v-tippy="{
                                content:
                                    'Entre em contato com suporte para trocar seu CPF',
                                placement: 'top-start',
                                arrow: false,
                            }"
                        />
                    </div>
                </div>
            </AppFormTemplate>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <AppButton type="submit"> Salvar </AppButton>
            </div>
        </Form>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { Form } from "vee-validate";
import { toast } from "vue3-toastify";
import { UserCircleIcon } from "@heroicons/vue/24/outline";
import AppButton from "../../components/AppButton.vue";
import AppInputText from "../../components/AppInputText.vue";
import AppFormTemplate from "../../components/AppFormTemplate.vue";
import AppTitlePages from "../../components/AppTitlePages.vue";
import AppCropper from "../../components/AppCropper.vue";
import UserStore from "../../store/User";
import Loading from "../../store/Loading";
import axiosClient from "../../plugins/axios";
import ProfileYup from "./ProfileYup";

onMounted(() => loadingUser());

const maskedCpf = "###.###.###-##";

const img = ref({
    dataURL: UserStore.state.user.profilePicture,
    blobURL: UserStore.state.user.profilePicture,
});

const loadingUser = () => {
    axiosClient.get("/User/Logged").then(({ data }) => {
        UserStore.state.user.name = data.name;
        UserStore.state.user.fullName = data.fullName;
        UserStore.state.user.email = data.email;
        UserStore.state.user.cpf = data.cpf;
        UserStore.state.user.profilePicture = data.profilePicture;
        UserStore.state.user.role = data.role;
    });
};

const onSubmit = () => {
    Loading.state.loading = true;

    const formData = new FormData();

    if (
        UserStore.state.user.fullName !== null &&
        UserStore.state.user.fullName !== undefined &&
        UserStore.state.user.fullName !== ""
    )
        formData.append("name", UserStore.state.user.fullName);

    if (img.value.dataURL !== UserStore.state.user.profilePicture)
        formData.append("profilePicture", img.value.dataURL);

    axiosClient
        .post(`/User/Prifile/Update`, formData)
        .then(({ data }) => {
            toast.success(data.message, {
                transition: toast.TRANSITIONS.BOUNCE,
                dangerouslyHTMLString: true,
            });

            loadingUser();
        })
        .catch((error) => {
            // errorMessage.value = error.response.data.errors;
        })
        .finally(() => {
            Loading.state.loading = false;
        });
};
</script>

<style></style>
