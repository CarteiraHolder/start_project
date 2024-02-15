<template>
    <div>
        <div :class="['relative mt-0 rounded-md shadow-sm', className]">
            <label
                v-show="label.length > 0"
                :for="name"
                class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900"
                >{{ label }}</label
            >
            <Field
                :id="id"
                :name="name"
                :type="type"
                :autocomplete="autocomplete"
                :class="[css]"
                :placeholder="placeholder"
                v-model="model"
                v-on:blur="lostFocus"
                :aria-invalid="error ? true : false"
                :aria-describedby="error ? 'email-error' : ''"
                v-maska
                :readonly="readonly"
                :disabled="disabled"
                :data-maska="mask"
            />
            <div
                v-if="error || HasErrorBackend"
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
            >
                <ExclamationCircleIcon
                    class="h-5 w-5 text-red-500"
                    aria-hidden="true"
                />
            </div>
        </div>
        <span
            v-if="ErrorBackend"
            :id="id"
            :name="name"
            class="mt-1 text-xs text-red-600"
            >{{ ErrorBackend }}
        </span>
        <ErrorMessage
            v-else
            :id="id"
            :name="name"
            class="mt-1 text-xs text-red-600"
        ></ErrorMessage>
    </div>
</template>

<script setup>
import { defineProps, ref, computed, onMounted } from "vue";
import { ExclamationCircleIcon } from "@heroicons/vue/20/solid";
import { Field, ErrorMessage } from "vee-validate";
import { vMaska, Mask } from "maska";
import store from "../store/RequestError";
import { bool } from "yup";

const props = defineProps({
    modelValue: { type: [String], default: "" },
    id: { type: String, default: "" },
    name: { type: String, default: "" },
    className: { type: String, default: "" },
    label: { type: String, default: "" },
    type: { type: String, default: "" },
    autocomplete: { type: String, default: "one-time-code" },
    placeholder: { type: String, default: "" },
    readonly: { type: Boolean, default: false },
    disabled: { type: Boolean, default: false },
    error: { type: String, default: "" },
    information: { type: String, default: "" },
    required: { type: Boolean, default: false },
    lostFocus: { type: Function },
    mask: { type: Array },
});

onMounted(() => {
    store.state.errors = [];
});

const HasErrorBackend = computed(() => ErrorBackend.value !== "");
const ErrorBackend = computed(() => {
    try {
        return store.state.errors[props.name][0] !== undefined
            ? store.state.errors[props.name][0]
            : "";
    } catch (error) {
        return "";
    }
});

const css = computed(() => {
    if (props.error || HasErrorBackend.value)
        return "block w-full rounded-md border-0 py-1.5 pr-10 text-red-900 ring-1 ring-inset ring-red-300 placeholder:text-red-300 focus:ring-2 focus:ring-inset focus:ring-red-500 sm:text-sm sm:leading-6";

    return "block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary-light sm:text-sm sm:leading-6";
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

<style scoped>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type="number"] {
    -moz-appearance: textfield;
}

input:disabled {
    background: #f9fafb;
}

/* input */
</style>
