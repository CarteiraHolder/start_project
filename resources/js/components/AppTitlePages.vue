<template>
    <div class="sm:flex sm:items-center border-b border-gray-200 pb-6">
        <div class="sm:flex-auto">
            <div
                class="-ml-4 -mt-4 flex flex-wrap items-center justify-between sm:flex-nowrap"
            >
                <div class="ml-4 mt-4">
                    <div class="flex">
                        <component
                            :is="icon"
                            class="h-6 w-6 shrink-0 text-secondary"
                            aria-hidden="true"
                        />
                        <h3
                            class="ms-1 text-xl font-semibold leading-6 text-primary"
                        >
                            {{ title }}
                        </h3>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ label }}
                    </p>
                </div>
            </div>
        </div>
        <span class="flex">
            <div
                class="mt-4 mr-1 sm:ml-16 sm:mt-0 sm:flex-none"
                v-show="exportExcelShow"
            >
                <AppButton @click="exportExcel" type="button">
                    Exportar
                </AppButton>
            </div>
            <div
                class="mt-4 mr-1 sm:ml-2 sm:mt-0 sm:flex-none"
                v-show="importExcelShow"
            >
                <AppButton type="submit"> Importar </AppButton>
            </div>

            <div
                class="mt-4 mr-1 sm:ml-2 sm:mt-0 sm:flex-none"
                v-show="buttonName.length > 0"
            >
                <AppButton @click="buttonClick"> {{ buttonName }} </AppButton>
            </div>
        </span>
    </div>
</template>

<script setup>
import { computed, defineProps } from "vue";
import AppButton from "../components/AppButton.vue";

const props = defineProps({
    icon: { default: null },
    title: { default: "" },
    label: { default: "" },
    buttonName: { type: String, default: "" },
    exportExcelShow: { type: Boolean, default: false },
    importExcelShow: { type: Boolean, default: false },
});

const emit = defineEmits(["exportExcel", "buttonClick"]);
const exportExcel = () => emit("exportExcel");
const buttonClick = () => emit("buttonClick");
</script>

<style></style>
