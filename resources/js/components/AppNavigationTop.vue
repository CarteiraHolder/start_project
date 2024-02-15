<template>
    <header class="border-b border-black/5">
        <!-- Secondary navigation -->
        <nav class="flex overflow-x-auto py-4">
            <ul
                role="list"
                class="flex min-w-full flex-none gap-x-6 px-4 text-base font-semibold leading-6 text-gray-400 sm:px-6 lg:px-8"
            >
                <template
                    v-for="(item, index) in secondaryNavigation"
                    :key="item.name"
                >
                    <template
                        v-if="item.role.length == 0 || item.role.includes(role)"
                    >
                        <li
                            v-if="
                                item.show ||
                                path.search('atualizar') > 0 ||
                                path.search('detalhado') > 0
                            "
                            class="flex items-center gap-x-4 lg:gap-x-6"
                        >
                            <div
                                v-if="index > 0"
                                class="h-6 w-px bg-gray-200"
                                aria-hidden="true"
                            ></div>

                            <router-link
                                :to="item.href"
                                :class="[
                                    item.href == path ||
                                    item.href.search('atualizar') > 0 ||
                                    item.href.search('detalhado') > 0
                                        ? 'text-primary'
                                        : '',
                                ]"
                            >
                                {{ item.name }}</router-link
                            >
                        </li>
                    </template>
                </template>
            </ul>
        </nav>
    </header>
    <router-view></router-view>
</template>

<script setup>
import { computed, defineProps } from "vue";
import router from "@/router/index";
import UserStore from "@/store/User.js";

const path = computed(() => router.currentRoute.value.path ?? "");
const role = computed(() => UserStore.state.user.role ?? "");

const props = defineProps({
    secondaryNavigation: { type: Array, default: [] },
});
</script>

<style></style>
