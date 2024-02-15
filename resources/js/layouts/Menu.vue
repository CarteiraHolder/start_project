<template>
    <div>
        <NavigationMobile :navigation="navigation" />
        <NavigationDesktop :navigation="navigation" />
        <NavigationTop> </NavigationTop>
        <!-- <div class="lg:pl-72">
            <main>
                <div>
                    <router-view name="navigation" />
                    <router-view />
                </div>
            </main>
        </div> -->
    </div>
</template>

<script setup>
import { onMounted, computed } from "vue";
import {
    CalendarIcon,
    ChartPieIcon,
    UsersIcon,
    HomeIcon,
    HomeModernIcon,
    BuildingStorefrontIcon,
    BuildingOffice2Icon,
    BeakerIcon,
    RectangleStackIcon,
    ArrowLeftOnRectangleIcon,
    FolderArrowDownIcon,
    CloudArrowUpIcon,
    UserCircleIcon,
    WrenchScrewdriverIcon,
} from "@heroicons/vue/24/outline";
import NavigationDesktop from "@/layouts/nav/NavigationDesktop.vue";
import NavigationMobile from "@/layouts/nav/NavigationMobile.vue";
import NavigationTop from "@/layouts/nav/NavigationTop.vue";
import axiosClient from "../plugins/axios";
import router from "@/router";
import { RolesAccess } from "../helpers/RolesAccess.js";
import store from "../store/User";

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

const navigation = computed(() => [
    {
        name: "Dashboard",
        href: "/dashboard",
        icon: HomeIcon,
        role: [],
        click: () => null,
    },
    {
        name: "Usuários",
        href: "/usuario/dashboard",
        active: "usuario",
        icon: UsersIcon,
        role: RolesAccess.user.menu,
        click: () => null,
    },

    {
        name: "Testes",
        href: "/teste",
        icon: BeakerIcon,
        role: RolesAccess.test.menu,
        click: () => null,
    },
    {
        name: "Configurações",
        href: "/configuracoes/dashboard",
        active: "configuracoes",
        icon: WrenchScrewdriverIcon,
        role: RolesAccess.test.menu,
        click: () => null,
    },
    {
        name: "Meu Cadastro",
        href: "/perfil/meu-cadastro",
        active: "perfil",
        icon: UserCircleIcon,
        role: RolesAccess.profile.all,
        click: () => null,
    },
    {
        name: "Sair",
        href: "#",
        icon: ArrowLeftOnRectangleIcon,
        role: [],
        click: SignOut,
    },
]);
</script>
