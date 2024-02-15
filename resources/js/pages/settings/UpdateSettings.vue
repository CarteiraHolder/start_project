<template>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <AppTitlePages
            :icon="WrenchScrewdriverIcon"
            title="Configurações"
            label="Preencha os campos a seguir para atualizar as configurações da plataforma"
        />

        <Form @submit="onSubmit" :validation-schema="Yup" v-slot="{ errors }">
            <AppFormTemplate :isSlideOver="true">
                <div class="grid grid-cols-2 gap-4">
                    <div class="sm:col-span-1 col-span-2">
                        <div class="mt-2">
                            <AppComboBoxApiGeolocation
                                name="apiGeolocation"
                                id="apiGeolocation"
                                label="API de Geolocalização"
                                v-model="apiGeolocation"
                                :error="errors.apiGeolocation"
                            />
                        </div>
                    </div>

                    <div class="sm:col-span-1 col-span-2">
                        <div class="mt-2">
                            <AppInputText
                                label="Clear log_user_actions | CRON (em dias)"
                                v-model="clearLogUserActions"
                                type="number"
                                name="apiGeoclearLogUserActionslocation"
                                id="apiGeoclearLogUserActionslocation"
                                :error="errors.clearLogUserActions"
                            />
                            <!-- <p class="text-xs text-amber-500 ms-1">
                                Rotina que deleta todos os logs antigos.
                            </p> -->
                        </div>
                    </div>

                    <div class="col-span-2">
                        <div class="relative flex items-start">
                            <div class="flex h-6 items-center">
                                <input
                                    v-model="clearAllCache"
                                    id="clearAllCache"
                                    aria-describedby="clearAllCache"
                                    name="clearAllCache"
                                    type="checkbox"
                                    class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary"
                                />
                            </div>
                            <div class="ml-3 text-sm leading-6">
                                <label
                                    for="clearAllCache"
                                    class="font-medium text-gray-900"
                                    >Limpar cache</label
                                >
                                <p id="clearAllCache" class="text-gray-500">
                                    Ao selecionar essa opção quando o CRON
                                    passar será executado o seguinte comando
                                    <span class="text-red-600">
                                        php artisan cache:clear
                                    </span>
                                </p>
                            </div>
                        </div>
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
import { ref, onMounted } from "vue";
import { WrenchScrewdriverIcon } from "@heroicons/vue/24/outline";
import { toast } from "vue3-toastify";
import { Form } from "vee-validate";
import axiosClient from "@/plugins/axios";
import AppTitlePages from "../../components/AppTitlePages.vue";
import AppButton from "../../components/AppButton.vue";
import AppInputText from "../../components/AppInputText.vue";
import AppFormTemplate from "../../components/AppFormTemplate.vue";
import AppComboBoxApiGeolocation from "../../components/ComboBox/AppComboBoxApiGeolocation.vue";
import Loading from "../../store/Loading";
import Yup from "./Yup";

const apiGeolocation = ref(null);
const clearLogUserActions = ref(90);
const clearAllCache = ref(false);
const seedVersion = ref(false);

onMounted(() => onLoadgin());

const onSubmit = () => {
    Loading.state.loading = true;

    const formData = new FormData();
    formData.append("apiGeolocation", apiGeolocation.value?.id);
    formData.append("clearLogUserActions", clearLogUserActions.value);
    formData.append("clearAllCache", clearAllCache.value);

    axiosClient
        .post(`/Settings/Update`, formData)
        .then(({ data }) => {
            toast.success(data.message, {
                transition: toast.TRANSITIONS.BOUNCE,
                dangerouslyHTMLString: true,
            });
            onLoadgin();
        })
        .catch((error) => {
            errorMessage.value = error.response.data.errors;
        })
        .finally(() => {
            Loading.state.loading = false;
        });
};

const onLoadgin = () => {
    axiosClient
        .get("/Settings/Get")
        .then(({ data }) => {
            apiGeolocation.value = {
                id: data.settings.api_geolocation,
                name: data.settings.api_geolocation,
            };
            clearLogUserActions.value = data.settings.clear_log_user_actions;
            clearAllCache.value = data.settings.clear_all_cache;
            seedVersion.value = data.settings.seed_version;
        })
        .catch((error) => {});
};
</script>

<style></style>
