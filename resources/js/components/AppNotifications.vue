<template>
    <button
        @click="openSlide"
        type="button"
        class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500"
    >
        <span class="sr-only">Ver Notificações</span>

        <BellAlertIcon
            v-show="bgColor == 'bg-primary'"
            class="h-6 w-6 text-primary"
            aria-hidden="true"
        />

        <BellIcon
            v-show="bgColor != 'bg-primary'"
            class="h-6 w-6"
            aria-hidden="true"
        />
    </button>
    <span
        v-if="count > 0"
        :class="[
            'sm:-ml-7 md:-ml-5 lg:-ml-7 -ml-6 text-center z-30 -mt-7 text-xs rounded-full text-white w-4 h-4 float-right',
            bgColor,
        ]"
    >
        <b>{{ count }}</b>
    </span>
    <AppSlideOvers :open="open" @close-click="open = false">
        <div class="flow-root">
            <div class="flex items-start justify-between border-b pb-4">
                <DialogTitle
                    class="text-base font-semibold leading-6 text-gray-900"
                    >Notificações</DialogTitle
                >
                <div class="ml-3 flex h-7 items-center">
                    <button
                        type="button"
                        class="relative rounded-md bg-white text-gray-400 hover:text-primary focus:outline-none"
                        @click="open = false"
                    >
                        <span class="absolute -inset-2.5" />
                        <span class="sr-only">Fechar painel</span>
                        <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
            </div>
            <div class="mt-4">
                <AppNotificationTimeline></AppNotificationTimeline>
            </div>
        </div>
    </AppSlideOvers>
</template>

<script setup>
import { ref, onBeforeMount } from "vue";
import { BellIcon, BellAlertIcon } from "@heroicons/vue/24/outline";
import AppSlideOvers from "./AppSlideOvers.vue";
import AppNotificationTimeline from "./AppNotificationTimeline.vue";
import axiosClient from "../plugins/axios";
import { Dialog } from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/20/solid";
import userStore from "../store/User";

import { webSocket } from "../plugins/webSocket";

const bgColor = ref("bg-gray-500");
const open = ref(false);
const count = ref(0);

setInterval(() => {
    if (count.value == 0) {
        bgColor.value = "bg-gray-500";
        return;
    }

    bgColor.value =
        bgColor.value == "bg-primary" ? "bg-gray-500" : "bg-primary";
}, 1000);

onBeforeMount(() => {
    getCountNotify();

    webSocket
        .private(`chennel.user.${userStore.state.user.id}`)
        .listen(".notification", (e) => {
            if (e?.notify == "new") getCountNotify();
        });
});

const getCountNotify = () => {
    axiosClient.get("Notification/Count").then(({ data }) => {
        count.value = data.count;
    });
};
const openSlide = () => {
    // if (count.value == 0) return;
    open.value = true;
    count.value = 0;
};
</script>

<style></style>
