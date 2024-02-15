<template>
    <AppNavigationTop :secondaryNavigation="secondaryNavigation" />
</template>

<script setup>
import AppNavigationTop from "../../components/AppNavigationTop.vue";
import { RolesAccess } from "../../helpers/RolesAccess.js";

const secondaryNavigation = [
    {
        name: "Configurações",
        href: "/configuracoes/dashboard",
        show: true,
        role: RolesAccess.settings.all,
    },
    {
        name: "Atualizar Configurações",
        href: "/configuracoes/editar",
        show: true,
        role: RolesAccess.settings.all,
    },
];
</script>

<style></style>
