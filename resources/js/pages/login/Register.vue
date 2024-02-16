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
                    <h2
                        class="mt-6 mb-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900"
                    >
                        Criar nova conta
                    </h2>
                </div>
                <!-- <Form @submit="onSubmit" :validation-schema="schema" v-slot="{ errors }" class="space-y-2 text-start" > -->
                <Form
                    @submit="onSubmit"
                    :validation-schema="RegisterYup"
                    v-slot="{ errors }"
                    class="space-y-2 text-start"
                >
                    <div>
                        <div class="mt-2">
                            <AppInputText
                                label="Nome"
                                type="text"
                                name="name"
                                id="name"
                                v-model="name"
                                autocomplete="name"
                                placeholder="Informe o seu nome"
                                :error="errors.name"
                            />
                        </div>
                    </div>
                    <div>
                        <div class="mt-4">
                            <AppInputText
                                label="Email"
                                type="text"
                                name="email"
                                id="email"
                                v-model="email"
                                autocomplete="email"
                                placeholder="Informe o seu e-mail"
                                :error="errors.email"
                            />
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center mt-4">
                            <input
                                id="acceptTheTerm"
                                name="acceptTheTerm"
                                v-model="acceptTheTerm"
                                type="checkbox"
                                class="h-4 w-4 rounded border-primary text-primary focus:ring-primary"
                            />
                            <label
                                for="acceptTheTerm"
                                class="ml-3 block text-sm leading-6 text-gray-900"
                            >
                                Eu li e concordo com termos e política
                            </label>
                        </div>

                        <div class="text-sm leading-6 mt-4">
                            <!-- <router-link
                                to="/esqueci-minha-senha"
                                class="font-semibold text-primary hover:text-primary-light"
                            >
                                Esqueceu sua senha?
                            </router-link> -->
                        </div>
                    </div>

                    <div>
                        <AppButton classButton="w-full" type="submit">
                            Criar nova conta
                        </AppButton>
                    </div>
                </Form>
                <p class="mt-10 text-center text-sm text-gray-500">
                    Já tem conta?
                    {{ " " }}
                    <router-link
                        to="/"
                        class="font-semibold text-primary hover:text-primary-light"
                    >
                        Acessar
                    </router-link>
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Form } from "vee-validate";
import { toast } from "vue3-toastify";
import router from "@/router";
import axiosClient from "@/plugins/axios";
import AppInputText from "@/components/AppInputText.vue";
import AppButton from "@/components/AppButton.vue";
import AppInputPassword from "@/components/AppInputPassword.vue";
import loading from "../../store/Loading";
import RegisterYup from "../../pages/login/RegisterYup";

const name = ref();
const email = ref();
const acceptTheTerm = ref(false);

const onSubmit = () => {
    if (acceptTheTerm.value == false) {
        toast.warning("Aceite os termos para realizar o cadastro", {
            toastId: `acceptTheTerm`,
            transition: toast.TRANSITIONS.BOUNCE,
            dangerouslyHTMLString: true,
            autoClose: 8000,
        });
        return;
    }

    loading.state.loading = true;

    const formData = new FormData();
    formData.append("name", name.value);
    formData.append("email", email.value);
    formData.append("acceptTheTerm", acceptTheTerm.value);

    axiosClient
        .post("/User/Login/Register", formData)
        .then(({ data }) => {
            toast.success(data.message, {
                toastId: `/User/Login/Register`,
                transition: toast.TRANSITIONS.BOUNCE,
                dangerouslyHTMLString: true,
                autoClose: 1000,
                onClose: () => {
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
