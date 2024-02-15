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

    if (props.role == "contractor-manager")
        return "inline-flex items-center rounded-md bg-orange-50 px-2 py-1 text-xs font-medium text-orange-700 ring-1 ring-inset ring-orange-600/10";

    if (props.role == "contractor-analyst")
        return "inline-flex items-center rounded-md bg-purple-50 px-2 py-1 text-xs font-medium text-purple-700 ring-1 ring-inset ring-purple-600/10";

    if (props.role == "contractor-coordinator")
        return "inline-flex items-center rounded-md bg-fuchsia-50 px-2 py-1 text-xs font-medium text-fuchsia-700 ring-1 ring-inset ring-fuchsia-600/10";

    if (props.role == "contractor-leader")
        return "inline-flex items-center rounded-md bg-pink-50 px-2 py-1 text-xs font-medium text-pink-700 ring-1 ring-inset ring-pink-600/10";

    if (props.role == "contractor-promoter")
        return "inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-700 ring-1 ring-inset ring-yellow-600/10";

    if (props.role == "flag-manager")
        return "inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/10";

    if (props.role == "flag-in-charge")
        return "inline-flex items-center rounded-md bg-lime-50 px-2 py-1 text-xs font-medium text-lime-700 ring-1 ring-inset ring-lime-600/10";

    if (props.role == "flag-buyer")
        return "inline-flex items-center rounded-md bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/10";

    if (props.role == "industry-manager")
        return "inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-600/10";

    if (props.role == "industry-seller")
        return "inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-600/10";

    if (props.role == "industry-commercial-representative")
        return "inline-flex items-center rounded-md bg-sky-50 px-2 py-1 text-xs font-medium text-sky-700 ring-1 ring-inset ring-sky-600/10";

    return `inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10`;
});
</script>

<style></style>
