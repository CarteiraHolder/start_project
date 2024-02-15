<template>
    <div class="lg:pl-72">
        <div
            class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8"
        >
            <button
                type="button"
                class="-m-2.5 p-2.5 text-gray-700 lg:hidden"
                @click="MenuStore.state.sidebarOpen = true"
            >
                <span class="sr-only">Open sidebar</span>
                <Bars3Icon class="h-6 w-6" aria-hidden="true" />
            </button>

            <!-- Separator -->
            <div class="h-6 w-px bg-gray-200 lg:hidden" aria-hidden="true" />

            <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                <form class="relative flex flex-1" action="#" method="GET">
                    <label for="search-field" class="sr-only">Search</label>
                    <MagnifyingGlassIcon
                        class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-400"
                        aria-hidden="true"
                    />
                    <input
                        id="search-field"
                        class="block h-full w-full border-0 py-0 pl-8 pr-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm"
                        placeholder="Search..."
                        type="search"
                        name="search"
                    />
                </form>
                <div class="flex items-center gap-x-4 lg:gap-x-6">
                    <AppNotifications />

                    <!-- Separator -->
                    <div
                        class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200"
                        aria-hidden="true"
                    />

                    <!-- Profile dropdown -->
                    <Menu as="div" class="relative">
                        <MenuButton class="-m-1.5 flex items-center p-1.5">
                            <span class="sr-only">Abrir menu</span>
                            <img
                                class="h-8 w-8 rounded-full bg-gray-50"
                                :src="
                                    store.state.user.profilePicture ??
                                    '/assets/images/profile-picture.jpeg'
                                "
                                alt=""
                            />
                            <span class="hidden lg:flex lg:items-center">
                                <span
                                    class="ml-4 text-sm font-semibold leading-6 text-gray-900"
                                    aria-hidden="true"
                                    >{{ store.state.user.name ?? "" }}</span
                                >
                                <ChevronDownIcon
                                    class="ml-2 h-5 w-5 text-gray-400"
                                    aria-hidden="true"
                                />
                            </span>
                        </MenuButton>
                        <transition
                            enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95"
                        >
                            <MenuItems
                                class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                            >
                                <MenuItem
                                    v-for="item in userNavigation"
                                    :key="item.name"
                                    v-slot="{ active }"
                                >
                                    <a
                                        @click="item?.click()"
                                        :href="item.href"
                                        :class="[
                                            active ? 'bg-gray-50' : '',
                                            'block px-3 py-1 text-sm leading-6 text-gray-900',
                                        ]"
                                        >{{ item.name }}</a
                                    >
                                </MenuItem>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
            </div>
        </div>

        <div
            @click="exitInspecting()"
            v-if="token.loginToken != token.token"
            class="cursor-pointer"
        >
            <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
                <div class="flex">
                    <div class="ml-3 mt-1">
                        <p class="text-sm text-yellow-700">
                            Você está inspecionando o usuário:
                            <b>{{ store.state.user.name }}</b> {{ " " }}
                            clique aqui para voltar para seu usuário
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <main>
            <div>
                <router-view name="navigation" />
                <router-view />
            </div>
        </main>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import MenuStore from "@/store/Menu.js";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import {
    Bars3Icon,
    MagnifyingGlassIcon,
    ChevronDownIcon,
} from "@heroicons/vue/24/outline";
import axiosClient from "@/plugins/axios";
import router from "@/router";
import store from "../../store/User";
import AppNotifications from "../../components/AppNotifications.vue";

const SignOut = () => {
    axiosClient.get("/Auth/Logout").then(({ data }) => {
        store.state.user = {
            id: "",
            name: "",
            email: "",
            profilePicture: null,
            role: "",
        };
        router.push({ path: "/" });
    });
};
const UserName = ref("");
const userNavigation = [
    { name: "Meu Cadastro", href: "/perfil/meu-cadastro", click: () => null },
    { name: "Sair", href: "#", click: SignOut },
];

const token = computed(() => {
    return {
        token: localStorage.token,
        loginToken: localStorage.loginToken,
    };
});

const exitInspecting = () => {
    localStorage.token = localStorage.loginToken;
    window.location.reload(true);
};
</script>

<style></style>
