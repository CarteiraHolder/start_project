<template>
    <span :class="badgeClass">
        <strong> {{ roleName(role) }}</strong>
    </span>
</template>

<script setup>
import { defineProps, computed } from "vue";
import { roleName } from "../helpers/RoleName";

const props = defineProps({
    role: { type: String, default: "" },
});

const badgeClass = computed(() => {
    if (props.role == "admin")
        return "inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10";

    if (props.role == "user")
        return "inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/10";

    return `inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10`;
});
</script>

<style></style>
