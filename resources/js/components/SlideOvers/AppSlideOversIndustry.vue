<template>
    <!-- Slider Industry -->
    <AppSlideOvers :open="openSliderIndustry" @closeClick="handleClick()">
        <IndustryRegister
            v-if="!industry"
            @closeClick="handleClick()"
            :isSlideOver="true"
        ></IndustryRegister>
        <IndustryUpdate
            v-else
            @closeClick="
                handleClick();
                industry = null;
            "
            :isSlideOver="true"
            :id="industry.id"
        ></IndustryUpdate>
    </AppSlideOvers>
</template>

<script setup>
import AppSlideOvers from "../AppSlideOvers.vue";
import IndustryRegister from "../../pages/industry/Register.vue";
import IndustryUpdate from "../../pages/industry/Update.vue";

const props = defineProps({
    openSliderIndustry: { type: [Boolean], default: false },
    industry: { type: [Object], default: null },
});

const emit = defineEmits(["closeClick"]);

const handleClick = () => {
    emit("closeClick");
};
</script>

<style></style>
