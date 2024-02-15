<template>
    <Loading></Loading>
    <div v-if="router.currentRoute.value.meta.requeresAuth">
        <Menu></Menu>
    </div>
    <div v-else class="page-login bg-gray-light">
        <router-view />
    </div>
</template>

<script setup>
import router from "@/router";
import Menu from "@/layouts/Menu.vue";
import Loading from "./Loading.vue";
</script>

<style>
/* LOADING DAS PAGINAS */
.page-login {
    height: 100vh;
    background-size: cover;
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-height: 100%;
}

/* DO COMPONENTE EASY TABLE */
.customize-table {
    --easy-table-border: 0px solid white;

    --easy-table-header-font-color: white;
    --easy-table-header-background-color: #081466;

    --easy-table-scrollbar-thumb-color: #081466;
}

/* CSS EM GERAL */
.vue3-easy-data-table__main {
    border-radius: 10px !important;
    /* border: 1px solid #081466 !important; */
}
.cursor-pointer {
    cursor: pointer;
}
</style>
