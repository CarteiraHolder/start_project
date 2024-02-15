<template>
    <Combobox as="div" v-model="model">
        <div class="relative">
            <label
                v-show="label.length > 0"
                :for="name"
                class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900"
                >{{ label }}</label
            >
            <ComboboxInput
                :id="id"
                :name="name"
                :class="css"
                v-on:keyup.enter="enterPress"
                @change="query = $event.target.value"
                :display-value="(item) => item?.name"
                autocomplete="one-time-code"
            />
            <ComboboxButton
                class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none"
            >
                <ChevronUpDownIcon
                    class="h-5 w-5 text-gray-400"
                    aria-hidden="true"
                />
            </ComboboxButton>

            <ComboboxOptions
                v-if="filtered.length > 0"
                class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
            >
                <ComboboxOption
                    v-for="item in filtered"
                    :key="item.id"
                    :value="item"
                    as="template"
                    v-slot="{ active, selected }"
                >
                    <li
                        :class="[
                            'relative cursor-default select-none py-2 pl-8 pr-4',
                            active ? 'bg-primary text-white' : 'text-gray-900',
                        ]"
                    >
                        <span
                            :class="[
                                'block truncate',
                                selected && 'font-semibold',
                            ]"
                        >
                            {{ item.name }}
                        </span>

                        <span
                            v-if="selected"
                            :class="[
                                'absolute inset-y-0 left-0 flex items-center pl-1.5',
                                active ? 'text-white' : 'text-secondary',
                            ]"
                        >
                            <CheckIcon class="h-5 w-5" aria-hidden="true" />
                        </span>
                    </li>
                </ComboboxOption>
            </ComboboxOptions>
        </div>
    </Combobox>

    <ErrorMessage :id="id" :name="name" class="mt-1 text-xs text-red-600" />
    <Field
        :id="id"
        :name="name"
        :class="css"
        v-model="model"
        style="display: none"
    />
</template>

<script setup>
import { Field, ErrorMessage } from "vee-validate";
import { computed, ref, defineProps, onMounted, watch } from "vue";
import { CheckIcon, ChevronUpDownIcon } from "@heroicons/vue/20/solid";
import axiosClient from "@/plugins/axios";
import {
    Combobox,
    ComboboxButton,
    ComboboxInput,
    ComboboxLabel,
    ComboboxOption,
    ComboboxOptions,
} from "@headlessui/vue";
import { roleName } from "../../helpers/RoleName";

const props = defineProps({
    modelValue: { type: [Object], default: null },
    id: { type: String, default: "" },
    industry: { type: Object, default: 0 },
    name: { type: String, default: "" },
    label: { type: String, default: "" },
    error: { type: String, default: "" },
    reload: { type: String, default: "" },
    allPermissions: { type: Boolean, default: false },
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

const css = computed(() => {
    if (props.error)
        return "block w-full rounded-md border-0 py-1.5 pr-10 text-red-900 ring-1 ring-inset ring-red-300 placeholder:text-red-300 focus:ring-2 focus:ring-inset focus:ring-red-500 sm:text-sm sm:leading-6";

    return "block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary-light sm:text-sm sm:leading-6";
});

onMounted(() => loading());

const list = ref([]);
const loading = () => {
    list.value = [
        { id: null, name: "Todos" },
        { id: true, name: "Erro" },
        { id: false, name: "Sucesso" },
    ];
};

const enterPress = () => {
    if (query.value == "") model.value = null;
};

const query = ref("");
const filtered = computed(() =>
    query.value === ""
        ? list.value
        : list.value.filter((item) => {
              return item.name
                  .toLowerCase()
                  .includes(query.value.toLowerCase());
          })
);

watch(
    () => [props.reload],
    (newValue, oldValue) => loading()
);
</script>
