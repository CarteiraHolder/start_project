<template>
    <Switch
        @click="openModal = true"
        :value="isChecked"
        :class="[
            isChecked ? 'bg-primary' : 'bg-gray-200',
            'relative inline-flex h-4 w-8 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2',
        ]"
    >
        <span class="sr-only">{{ isChecked ? "Marcado" : "Desmarcado" }}</span>
        <span
            aria-hidden="true"
            :class="[
                isChecked ? 'translate-x-4' : 'translate-x-0',
                'pointer-events-none inline-block h-3 w-3 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
            ]"
        >
            <!-- ICON TRUE -->
            <svg
                v-if="isChecked"
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
                v-if="!isChecked"
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
    <AppModalQuestion :open="openModal">
        <template v-slot:buttons>
            <AppButton
                classButton="ml-4"
                @click="
                    openModal = false;
                    changeChecked();
                "
            >
                Sim
            </AppButton>
            <AppButton
                textColor="gray-900"
                bgColor="gray"
                bgColorHover="white"
                shadow=""
                @click="openModal = false"
            >
                Cancelar
            </AppButton>
        </template>
        <template v-slot:title>
            <span class="text-xl text-slate-900"> {{ title }}</span>
        </template>
        <template v-slot:label>
            {{ label }}
        </template>
    </AppModalQuestion>
</template>

<script setup>
import { defineProps, computed, ref } from "vue";
import { Switch } from "@headlessui/vue";
import AppModalQuestion from "./Modal/AppModalQuestion.vue";
import AppButton from "./AppButton.vue";

const openModal = ref(false);

const props = defineProps({
    isChecked: { type: [Boolean], default: false },
    title: { type: [String], default: "Deseja mesmo realizar essa ação?" },
    label: { type: [String], default: "" },
});

const changeChecked = () => emit("changeChecked");

const emit = defineEmits(["changeChecked"]);
</script>

<style>
:root {
    --popper-theme-background-color: #ffffff;
    --popper-theme-background-color-hover: #ffffff;
    --popper-theme-text-color: #333333;
    --popper-theme-border-width: 1px;
    --popper-theme-border-style: solid;
    --popper-theme-border-color: #eeeeee;
    --popper-theme-border-radius: 6px;
    --popper-theme-padding: 10px;
    --popper-theme-box-shadow: 0 6px 30px -6px rgba(0, 0, 0, 0.25);
}
</style>
