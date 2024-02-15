<template>
    <!-- Slider Flag -->
    <AppSlideOvers :open="openSlider" @closeClick="handleClick()">
        <FlagRegister
            v-if="!flag"
            @closeClick="handleClick()"
            :isSlideOver="true"
        ></FlagRegister>
        <FlagUpdate
            v-else
            @closeClick="
                handleClick();
                flag = null;
            "
            :isSlideOver="true"
            :id="flag.id"
        ></FlagUpdate>
    </AppSlideOvers>
</template>

<script setup>
import AppSlideOvers from "../AppSlideOvers.vue";
import FlagRegister from "../../pages/flag/Register.vue";
import FlagUpdate from "../../pages/flag/Update.vue";

const props = defineProps({
    openSlider: { type: [Boolean], default: false },
    flag: { type: [Object], default: null },
});

const emit = defineEmits(["closeClick"]);

const handleClick = () => {
    emit("closeClick");
};
</script>

<style></style>
