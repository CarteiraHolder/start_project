<template>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <AppTitlePages
            :icon="WrenchScrewdriverIcon"
            title="Configurações"
            label="Variáveis do sistema, elas são responsáveis pelo comportamento da plataforma."
        />

        <div v-if="show" class="mt-6">
            <div class="lg:flex lg:divide-x lg:divide-dashed">
                <div class="lg:flex-none">
                    <ul
                        role="list"
                        class="mt-3 grid grid-cols-1 gap-5 sm:grid-cols-2 sm:gap-6 lg:grid-cols-3"
                    >
                        <li
                            v-for="card in cards"
                            :key="card.name"
                            class="col-span-1 flex rounded-md shadow-sm"
                        >
                            <div
                                :class="[
                                    card.bgColor,
                                    'flex w-16 flex-shrink-0 items-center justify-center rounded-l-md text-sm font-medium text-white',
                                ]"
                            >
                                {{ card.initials }}
                            </div>
                            <div
                                class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white"
                            >
                                <div class="flex-1 truncate px-4 py-2 text-sm">
                                    <span
                                        class="font-medium text-gray-900 hover:text-gray-600"
                                    >
                                        {{ card.name }}
                                    </span>
                                    <p class="text-gray-500">
                                        {{ card.label }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="lg:flex-1 w-64 lg:px-5 lg:mx-5">
                    <div class="flow-root">
                        <h1 class="my-2">Backups</h1>
                        <AppButton @click="makeBackup" class="w-full"
                            >Fazer um backup</AppButton
                        >
                        <ul role="list" class="-mb-8 mt-5">
                            <li
                                v-for="(event, eventIdx) in timeline"
                                :key="event.id"
                            >
                                <div class="relative pb-4">
                                    <span
                                        v-if="eventIdx !== timeline.length - 1"
                                        class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200"
                                        aria-hidden="true"
                                    ></span>
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span
                                                :class="[
                                                    event.iconBackground,
                                                    'h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white',
                                                ]"
                                            >
                                                <component
                                                    :is="event.icon"
                                                    class="h-5 w-5 text-white"
                                                    aria-hidden="true"
                                                />
                                            </span>
                                        </div>
                                        <div
                                            class="flex min-w-0 flex-1 justify-between space-x-4"
                                        >
                                            <div>
                                                <p
                                                    class="text-sm text-gray-500"
                                                >
                                                    {{ event.content }}
                                                    <span
                                                        class="font-medium text-gray-900"
                                                        >{{
                                                            event.target
                                                        }}</span
                                                    >
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { WrenchScrewdriverIcon } from "@heroicons/vue/24/outline";
import axiosClient from "@/plugins/axios";
import AppTitlePages from "../../components/AppTitlePages.vue";
import AppButton from "../../components/AppButton.vue";
import { toast } from "vue3-toastify";
import {
    CheckIcon,
    HandThumbUpIcon,
    CircleStackIcon,
} from "@heroicons/vue/20/solid";

const cards = ref([]);
const backup = ref([]);
const timeline = ref([]);
const show = ref(false);

onMounted(() => {
    onLoadgin();
    setInterval(() => {
        onLoadgin();
    }, 1000 * 10);
});

const onLoadgin = () => {
    axiosClient
        .get("/Settings/Get")
        .then(({ data }) => {
            timeline.value = [];

            data.backups.forEach((element, index) => {
                timeline.value.push({
                    id: index,
                    content: element.name,
                    target: element.size,
                    date: "",
                    icon: CircleStackIcon,
                    iconBackground: "bg-gray-400",
                });
            });

            const date = new Date();
            date.setDate(date.getDate() - data.settings.clear_log_user_actions);

            cards.value = [];
            cards.value.push({
                name: `db:seed`,
                initials: "SEED",
                label: `Versão ${data.settings.seed_version}`,
                bgColor: "bg-primary",
            });

            cards.value.push({
                name: `Geolocalização`,
                initials: "API",
                label: data.settings.api_geolocation,
                bgColor: "bg-secondary",
            });

            cards.value.push({
                name: `Exclusão de Logs (${data.settings.clear_log_user_actions} dias)`,
                initials: "CRON",
                label: `Mais antigos que ${date.toLocaleDateString()}`,
                bgColor: "bg-primary-light",
            });

            cards.value.push({
                name: `cache:clear`,
                initials: "CACHE",
                label: data.settings.clear_all_cache
                    ? "Será executado em até 1h"
                    : "Não está agendado",
                bgColor: "bg-secondary-light",
            });
            show.value = true;
        })
        .catch((error) => {});
};

const makeBackup = () => {
    axiosClient.get(`/Settings/Backup/Create`).then(({ data }) => {
        toast.success(data.message, {
            transition: toast.TRANSITIONS.BOUNCE,
            dangerouslyHTMLString: true,
        });
    });
};
</script>

<style></style>
