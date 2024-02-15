<template>
    <AppNavigationTop :secondaryNavigation="secondaryNavigation" />
</template>

<script setup>
import AppNavigationTop from "../../components/AppNavigationTop.vue";
import { RolesAccess } from "../../helpers/RolesAccess.js";

const secondaryNavigation = [
    {
        name: "Meu Cadastro",
        href: "/perfil/meu-cadastro",
        show: true,
        role: RolesAccess.profile.all,
    },
    {
        name: "Trocar Senha",
        href: "/perfil/trocar-senha",
        show: true,
        role: RolesAccess.profile.all,
    },
];
</script>

<style></style>
