<template>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <AppTitlePages
            :icon="UserCircleIcon"
            title="Meu Cadastro"
            label="Preencha os campos a seguir para trocar sua senha."
        />
        <Form
            @submit="onSubmit"
            :validation-schema="ChagePasswordYup"
            v-slot="{ errors }"
        >
            <AppFormTemplate :isSlideOver="true">
                <div class="sm:col-span-1 col-span-3">
                    <AppInputPassword
                        id="currencyPassword"
                        name="currencyPassword"
                        v-model="currencyPassword"
                        label="Senha Atual"
                        class-name="lg:w-2/4"
                        :error="errors.currencyPassword"
                    />
                </div>

                <div class="sm:col-span-1 col-span-3">
                    <AppInputPassword
                        id="newPassword"
                        name="newPassword"
                        label="Nova senha"
                        v-model="newPassword"
                        class-name="lg:w-2/4"
                        :error="errors.newPassword"
                    />
                </div>

                <div class="sm:col-span-1 col-span-3">
                    <AppInputPassword
                        id="repeatNewPassword"
                        name="repeatNewPassword"
                        label="Repita sua nova senha"
                        v-model="repeatNewPassword"
                        class-name="lg:w-2/4"
                        :error="errors.repeatNewPassword"
                    />
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
import AppInputPassword from "../../components/AppInputPassword.vue";
import AppFormTemplate from "../../components/AppFormTemplate.vue";
import AppTitlePages from "../../components/AppTitlePages.vue";
import UserStore from "../../store/User";
import Loading from "../../store/Loading";
import axiosClient from "../../plugins/axios";
import ChagePasswordYup from "./ChagePasswordYup";

const currencyPassword = ref("");
const newPassword = ref("");
const repeatNewPassword = ref("");

const onSubmit = () => {
    Loading.state.loading = true;

    const formData = new FormData();
    formData.append("currencyPassword", currencyPassword.value);
    formData.append("newPassword", newPassword.value);

    axiosClient
        .post(`/User/Prifile/Change/Password`, formData)
        .then(({ data }) => {
            toast.success(data.message, {
                transition: toast.TRANSITIONS.BOUNCE,
                dangerouslyHTMLString: true,
            });
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
