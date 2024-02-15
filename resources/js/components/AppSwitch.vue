<template>
    <Switch
        v-model="model"
        :class="[
            model ? 'bg-primary' : 'bg-gray-200',
            'relative inline-flex h-4 w-8 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2',
        ]"
    >
        <span class="sr-only">Use setting</span>
        <span
            aria-hidden="true"
            :class="[
                model ? 'translate-x-4' : 'translate-x-0',
                'pointer-events-none inline-block h-3 w-3 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
            ]"
        >
            <!-- ICON TRUE -->
            <svg
                v-if="model"
                class="h-3 w-3"
                fill="currentColor"
                viewBox="0 0 12 12"
            >
                <path
                    d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z"
                />
            </svg>
            <!-- ICON FALSE -->
            <svg
                v-if="!model"
                class="h-3 w-3 text-gray-400"
                fill="none"
                viewBox="0 0 12 12"
            >
                <path
                    d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </span>
    </Switch>
</template>

<script setup>
import { Switch } from "@headlessui/vue";
import { defineProps, computed } from "vue";

const props = defineProps({
    modelValue: { type: [String], default: "" },
    click: { type: Function },
});

const emit = defineEmits(["update:modelValue"]);
const model = computed({
    get() {
        return props.modelValue;
    },
    set(value) {
        return emit("update:modelValue", value);
    },
});
</script>

<style></style>
