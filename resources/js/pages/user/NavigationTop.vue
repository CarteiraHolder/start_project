<template>
    <AppNavigationTop :secondaryNavigation="secondaryNavigation" />
</template>

<script setup>
import AppNavigationTop from "../../components/AppNavigationTop.vue";
import { RolesAccess } from "../../helpers/RolesAccess.js";

const secondaryNavigation = [
    {
        name: "Dashboard",
        href: "/usuario/dashboard",
        show: true,
        role: RolesAccess.user.dashboard,
    },
    {
        name: "Listagem",
        href: "/usuario/listar",
        show: true,
        role: RolesAccess.user.list,
    },
    {
        name: "Cadastrar",
        href: "/usuario/cadastrar",
        show: true,
        role: RolesAccess.user.register,
    },
    {
        name: "Atualizar",
        href: "/usuario/atualizar",
        show: false,
        role: RolesAccess.user.udpate,
    },
];
</script>

<style></style>
