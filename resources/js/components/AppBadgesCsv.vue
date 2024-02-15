<template>
    <span
        v-if="text == 'PDV'"
        :class="`inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10`"
    >
        <strong> {{ text }}</strong>
    </span>
    <span
        v-if="text == 'SKU'"
        :class="`inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-600/10`"
    >
        <strong> {{ text }}</strong>
    </span>
    <span
        v-if="text == 'USER'"
        :class="`inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/10`"
    >
        <strong> {{ text }}</strong>
    </span>
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps({
    text: { type: String, default: "" },
});
</script>

<style></style>
