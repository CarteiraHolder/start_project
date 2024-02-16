<template>
    <div
        class="flex min-h-full flex-1 flex-col justify-center py-12 sm:px-6 lg:px-8"
    >
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
            <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
                <img
                    class="mx-auto h-18 w-auto"
                    src="@/assets/image/logo.svg"
                    alt="Logo"
                />
                <div class="sm:mx-auto sm:w-full sm:max-w-md">
                    <h1
                        class="mt-6 text-md font-bold leading-9 tracking-tight text-gray-900"
                    >
                        Esqueceu sua senha?
                    </h1>
                    <div class="mb-6">
                        Informe seu e-mail para solicitar a troca de senha.
                    </div>
                </div>
                <!-- <Form @submit="onSubmit" :validation-schema="schema" v-slot="{ errors }" class="space-y-2 text-start" > -->
                <Form @submit="onSubmit" class="space-y-2 text-start">
                    <div>
                        <div class="mt-2">
                            <AppInputText
                                label="E-mail"
                                type="email"
                                name="email"
                                id="email"
                                v-model="email"
                                autocomplete="email"
                                placeholder="you@example.com"
                            />
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 mt-4">
                        <!-- <div class="text-sm leading-6">
                            <router-link
                                to="/"
                                class="font-semibold text-primary hover:text-primary-light"
                                >Voltar para a página login</router-link
                            >
                        </div> -->
                    </div>

                    <div>
                        <AppButton classButton="w-full" type="submit">
                            Enviar
                        </AppButton>
                    </div>
                </Form>
                <p class="mt-10 text-center text-sm text-gray-500">
                    Esqueça,
                    {{ " " }}
                    <router-link
                        to="/"
                        class="font-semibold text-primary hover:text-primary-light"
                    >
                        envie-me de volta
                    </router-link>
                    {{ " " }}
                    para a tela de login.
                </p>
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
import loading from "../../store/Loading";

const email = ref("");

const onSubmit = () => {
    loading.state.loading = true;

    const formData = new FormData();
    formData.append("email", email.value);

    axiosClient
        .post("/User/Forgot/Password", formData)
        .then(({ data }) => {
            email.value = "";
            toast.success(data.message, {
                toastId: `/User/Forgot/Password`,
                transition: toast.TRANSITIONS.BOUNCE,
                dangerouslyHTMLString: true,
                autoClose: 7000,
                onClose: () => {
                    loading.state.loading = true;
                    setTimeout(() => {
                        loading.state.loading = false;
                        router.push({ path: "/" });
                    }, 1000);
                },
            });
        })
        .catch((error) => {})
        .finally(() => (loading.state.loading = false));
};
</script>
