<template>
    <div v-if="timeline.length == 0">
        <p class="text-sm text-primary">Sem notificações.</p>
    </div>
    <ul role="list" class="-mb-8">
        <li v-for="(event, eventIdx) in timeline" :key="event.id">
            <div class="relative pb-8">
                <span
                    v-if="eventIdx !== timeline.length - 1"
                    class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200"
                    aria-hidden="true"
                />
                <div class="relative flex space-x-3">
                    <div class="mt-2">
                        <span
                            :class="[
                                'h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center ring-8 ring-white',
                                event.icon_background,
                            ]"
                        >
                            <component
                                class="h-5 w-5 text-white"
                                aria-hidden="true"
                                :is="getHeroIcons(event.icon)"
                            />
                        </span>
                    </div>
                    <div
                        class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5"
                    >
                        <div>
                            <p class="text-sm text-gray-900">
                                {{ event.title }}
                            </p>
                            <p class="font-sm text-gray-500">
                                {{ event.label }}
                            </p>
                            <p class="text-gray-400" style="font-size: 0.75rem">
                                {{ toLocaleDateString(event.created_at) }}
                                {{ toLocaleTimeString(event.created_at) }}
                            </p>
                        </div>
                    </div>
                    <TrashIcon
                        @click="deleteNotify(event.id)"
                        v-tippy="'Apagar'"
                        class="text-white bg-red-500 p-1 rounded w-6 h-6 mr-1 mt-2 cursor-pointer"
                    ></TrashIcon>
                </div>
            </div>
        </li>
    </ul>
</template>

<script setup>
import { ref, onBeforeMount } from "vue";
import { TrashIcon } from "@heroicons/vue/20/solid";
import * as heroIcons from "@heroicons/vue/20/solid";

import {
    toLocaleTimeString,
    toLocaleDateString,
} from "../helpers/DateFormating";
import axiosClient from "../plugins/axios";

const timeline = ref([]);

onBeforeMount(() => {
    axiosClient
        .get("Notification/All")
        .then(({ data }) => (timeline.value = data.data));
});

const deleteNotify = (id) => {
    axiosClient.get(`Notification/Delete/${id}`).then(({ data }) => {
        removeById(id);
    });
};

const removeById = (id) => {
    const requiredIndex = timeline.value.findIndex((el) => {
        return el.id === id;
    });
    if (requiredIndex === -1) {
        return false;
    }
    return !!timeline.value.splice(requiredIndex, 1);
};

const getHeroIcons = (icon) => heroIcons[icon];
</script>

<style></style>
