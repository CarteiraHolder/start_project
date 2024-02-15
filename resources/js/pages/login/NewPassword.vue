<template>
    <div
        class="flex min-h-full flex-1 flex-col justify-center py-12 sm:px-6 lg:px-8"
    >
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
            <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
                <img
                    class="mx-auto h-10 w-auto"
                    src="@/assets/image/logo.png"
                    alt="Logo"
                />
                <div class="sm:mx-auto sm:w-full sm:max-w-md">
                    <h1
                        class="mt-6 text-md font-bold leading-9 tracking-tight text-gray-900"
                    >
                        Olá, {{ name }}
                    </h1>
                    <div class="mb-6">
                        Preencha os campos abaixo para criar sua senha.
                    </div>
                </div>

                <Form
                    @submit="onSubmit"
                    :validation-schema="NewPasswordSchema"
                    v-slot="{ errors }"
                >
                    <div>
                        <div class="mt-2">
                            <AppInputPassword
                                label="Senha"
                                id="password"
                                name="password"
                                placeholder="******"
                                v-model="password"
                                :error="errors.password"
                            />
                        </div>
                    </div>

                    <div>
                        <div class="mt-4">
                            <AppInputPassword
                                label="Repita sua Senha"
                                id="rePassword"
                                name="rePassword"
                                placeholder="******"
                                v-model="rePassword"
                                :error="errors.rePassword"
                            />
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <div class="text-sm leading-6">
                            <router-link
                                to="/"
                                class="font-semibold text-primary hover:text-primary-light"
                                >Voltar para a página login</router-link
                            >
                        </div>
                    </div>

                    <div>
                        <AppButton classButton="w-full" type="submit">
                            Cadastrar
                        </AppButton>
                    </div>
                </Form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onBeforeMount } from "vue";
import { toast } from "vue3-toastify";
import { Form } from "vee-validate";
import router from "@/router";
import axiosClient from "../../plugins/axios";
import AppInputPassword from "@/components/AppInputPassword.vue";
import AppButton from "@/components/AppButton.vue";
import loading from "../../store/Loading";
import NewPasswordSchema from "../../pages/login/NewPasswordYup";

const name = ref("");
const password = ref("");
const rePassword = ref("");

onBeforeMount(() => {
    loading.state.loading = true;
    axiosClient
        .get(`/User/Hash/${router.currentRoute.value.params.hash}`)
        .then(({ data }) => {
            name.value = data.data.name;
        })
        .catch(() => {})
        .finally(() => (loading.state.loading = false));
});

const onSubmit = () => {
    loading.state.loading = true;
    const formData = new FormData();
    formData.append("password", password.value);
    formData.append("rePassword", rePassword.value);
    formData.append("hash", router.currentRoute.value.params.hash);

    axiosClient
        .post("/User/New/Password", formData)
        .then(({ data }) => {
            // password.value = "";
            // rePassword.value = "";
            toast.success(data.message, {
                toastId: `/User/New/Password`,
                transition: toast.TRANSITIONS.BOUNCE,
                dangerouslyHTMLString: true,
                autoClose: 1000,
                onClose: () => {
                    loading.state.loading = true;
                    setTimeout(() => {
                        loading.state.loading = false;
                        router.push({ path: "/" });
                    }, 1000);
                },
            });
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => (loading.state.loading = false));
};
</script>
