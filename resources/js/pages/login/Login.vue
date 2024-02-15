<template>
    <div
        class="flex min-h-full flex-1 flex-col justify-center py-12 sm:px-6 lg:px-8"
    >
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
            <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
                <img
                    class="mx-auto h-10 w-auto"
                    src="@/assets/image/logo.svg"
                    alt="Logo"
                />
                <div class="sm:mx-auto sm:w-full sm:max-w-md">
                    <h2
                        class="mt-6 mb-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900"
                    >
                        Faça login em sua conta
                    </h2>
                </div>
                <!-- <Form @submit="onSubmit" :validation-schema="schema" v-slot="{ errors }" class="space-y-2 text-start" > -->
                <Form @submit="onSubmit" class="space-y-2 text-start">
                    <div>
                        <div class="mt-2">
                            <AppInputText
                                label="CPF ou Email"
                                type="text"
                                name="email"
                                id="email"
                                v-model="email"
                                autocomplete="email"
                                placeholder="Informe o seu CPF ou E-mail"
                            />
                        </div>
                    </div>

                    <div>
                        <div class="mt-4">
                            <AppInputPassword
                                label="Senha"
                                id="password"
                                name="password"
                                autocomplete="current-password"
                                required=""
                                placeholder="******"
                                v-model="password"
                            />
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <!-- <input
                                id="remember-me"
                                name="remember-me"
                                type="checkbox"
                                class="h-4 w-4 rounded border-primary text-primary focus:ring-primary"
                            />
                            <label
                                for="remember-me"
                                class="ml-3 block text-sm leading-6 text-gray-900"
                                >Remember me</label
                            > -->
                        </div>

                        <div class="text-sm leading-6 mt-4">
                            <router-link
                                to="/esqueci-minha-senha"
                                class="font-semibold text-primary hover:text-primary-light"
                                >Esqueceu sua senha?</router-link
                            >
                        </div>
                    </div>

                    <div>
                        <AppButton classButton="w-full" type="submit">
                            Entrar
                        </AppButton>
                    </div>
                </Form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { toast } from "vue3-toastify";
import { Form } from "vee-validate";
import router from "@/router";
import axiosClient from "@/plugins/axios";
import AppInputText from "@/components/AppInputText.vue";
import AppButton from "@/components/AppButton.vue";
import AppInputPassword from "@/components/AppInputPassword.vue";
import { useBattery } from "@vueuse/core";
import { useGeolocation } from "@vueuse/core";
import loading from "../../store/Loading";

const { level } = useBattery();
const { coords } = useGeolocation();

const email = ref("fhstefanutto@gmail.com");
const password = ref("123123123");

const onSubmit = () => {
    loading.state.loading = true;

    setTimeout(() => {
        const formData = new FormData();
        formData.append("email", email.value);
        formData.append("password", password.value);
        formData.append("batteryLevel", level.value * 100);

        if (isFinite(coords.value.latitude))
            formData.append("latitude", coords.value.latitude);

        if (isFinite(coords.value.longitude))
            formData.append("longitude", coords.value.longitude);

        axiosClient
            .post("/Auth/Login", formData)
            .then(({ data }) => {
                localStorage.token = data.token;
                localStorage.loginToken = data.token;
                router.push({ path: "/dashboard" });
            })
            .catch((error) => {})
            .finally(() => (loading.state.loading = false));
    }, 2000);
};
</script>
