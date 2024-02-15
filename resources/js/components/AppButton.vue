<template>
    <button
        :type="type"
        :class="[
            'rounded-md',
            `bg-${bgColor}`,
            'px-3',
            'py-2',
            'text-sm',
            'font-semibold',
            `text-${textColor}`,
            shadow,
            `hover:bg-${bgColorHover}`,
            'focus-visible:outline',
            'focus-visible:outline-2',
            'focus-visible:outline-offset-2',
            `focus-visible:outline-${bgColorHover}`,
            classButton,
        ]"
        @click="handleClick"
    >
        <slot></slot>
    </button>
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps({
    type: { type: String, default: "button" },
    textColor: { type: String, default: "white" },
    bgColor: { type: String, default: "primary" },
    bgColorHover: { type: String, default: "primary-light" },
    shadow: { type: String, default: "shadow-sm" },
    classButton: { type: String, default: "" },
});

const emit = defineEmits(["click"]);

const handleClick = () => {
    emit("click");
};
</script>

<style></style>
