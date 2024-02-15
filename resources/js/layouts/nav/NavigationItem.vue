<template>
    <nav class="flex flex-1 flex-col">
        <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
                <ul role="list" class="-mx-2 space-y-1">
                    <li v-for="item in navigation" :key="item.name">
                        <template
                            v-if="
                                item.role.length == 0 ||
                                item.role.includes(role)
                            "
                        >
                            <router-link
                                v-if="!item.children"
                                :to="item.href"
                                @click="
                                    MenuStore.state.sidebarOpen = false;
                                    item?.click();
                                "
                                :class="[
                                    item.href == path ||
                                    path.search(item?.active) > 0
                                        ? 'bg-primary text-white'
                                        : 'hover:bg-primary-light hover:text-white',
                                    'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-primary',
                                ]"
                            >
                                <component
                                    :is="item.icon"
                                    class="h-6 w-6 shrink-0 text-secondary"
                                    aria-hidden="true"
                                />
                                {{ item.name }}
                            </router-link>
                            <Disclosure as="div" v-else v-slot="{ open }">
                                <DisclosureButton
                                    :class="[
                                        item.href == path
                                            ? 'bg-primary text-white'
                                            : 'hover:bg-primary-light hover:text-white',
                                        'flex items-center w-full text-left rounded-md p-2 gap-x-3 text-sm leading-6 font-semibold text-primary',
                                    ]"
                                >
                                    <component
                                        :is="item.icon"
                                        class="h-6 w-6 shrink-0 text-secondary"
                                        aria-hidden="true"
                                    />
                                    {{ item.name }}
                                    <ChevronRightIcon
                                        :class="[
                                            open
                                                ? 'rotate-90 text-gray-500'
                                                : 'text-gray-400',
                                            'ml-auto h-5 w-5 shrink-0',
                                        ]"
                                        aria-hidden="true"
                                    />
                                </DisclosureButton>
                                <DisclosurePanel as="ul" class="mt-1 px-2">
                                    <li
                                        v-for="subItem in item.children"
                                        :key="subItem.name"
                                        class="py-1"
                                    >
                                        <!-- 44px -->
                                        <router-link
                                            :to="subItem.href"
                                            @click="
                                                MenuStore.state.sidebarOpen = false
                                            "
                                            :class="[
                                                subItem.href == path
                                                    ? 'bg-primary text-white'
                                                    : 'hover:bg-primary-light hover:text-white',
                                                'block rounded-md py-2 pr-2 pl-9 text-sm leading-6 text-primary',
                                            ]"
                                            >{{ subItem.name }}</router-link
                                        >
                                    </li>
                                </DisclosurePanel>
                            </Disclosure>
                        </template>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</template>

<script setup>
import { computed } from "vue";
import { ChevronRightIcon } from "@heroicons/vue/20/solid";
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import router from "@/router/index";
import MenuStore from "@/store/Menu.js";
import UserStore from "../../store/User.js";

const props = defineProps({
    navigation: { type: Array },
});

const path = computed(() => router.currentRoute.value.path ?? "");
const role = computed(() => UserStore.state.user.role ?? "");
</script>

<style></style>
