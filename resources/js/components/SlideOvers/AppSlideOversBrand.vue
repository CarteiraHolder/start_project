<template>
    <!-- Slider brand -->
    <AppSlideOvers :open="openSlider" @closeClick="handleClick()">
        <BrandRegister
            v-if="!brand"
            @closeClick="handleClick()"
            :isSlideOver="true"
        ></BrandRegister>
        <BrandUpdate
            v-else
            @closeClick="
                handleClick();
                brand = null;
            "
            :isSlideOver="true"
            :id="brand.id"
        ></BrandUpdate>
    </AppSlideOvers>
</template>

<script setup>
import AppSlideOvers from "../AppSlideOvers.vue";
import BrandRegister from "../../pages/brand/Register.vue";
import BrandUpdate from "../../pages/brand/Update.vue";

const props = defineProps({
    openSlider: { type: [Boolean], default: false },
    brand: { type: [Object], default: null },
});

const emit = defineEmits(["closeClick"]);

const handleClick = () => {
    emit("closeClick");
};
</script>

<style></style>
