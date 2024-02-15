<template>
    <div>
        <!-- Select a picture for cropping -->
        <section class="section">
            <!-- Set a button that invokes selecting an image -->
            <button type="button" class="select-picture">
                <label
                    :class="[
                        'rounded-md',
                        `bg-primary`,
                        'px-3',
                        'py-2',
                        'text-sm',
                        'font-semibold',
                        `text-white`,
                        `hover:bg-primary-light`,
                        'focus-visible:outline',
                        'focus-visible:outline-2',
                        'focus-visible:outline-offset-2',
                        `focus-visible:outline-primary`,
                        `cursor-pointer`,
                    ]"
                    for="file-upload"
                >
                    {{ buttonName }}
                    <input
                        id="file-upload"
                        name="file-upload"
                        class="sr-only"
                        ref="uploadInput"
                        type="file"
                        accept="image/jpg, image/jpeg, image/png, image/gif"
                        @change="selectFile"
                    />
                </label>
            </button>
        </section>

        <!-- Crop result preview -->
        <!-- <section class="section" v-if="model.value.dataURL && model.value.blobURL">
            <p>A preview of the cropped Base64 image:</p>
            <div class="preview">
                <img :src="model.value.dataURL" />
            </div>
            <p>A preview of the cropped blob image:</p>
            <div class="preview">
                <img :src="model.value.blobURL" />
            </div>
            <p>Press F12 to see the printed base64 / blob / file results.</p>
        </section> -->

        <!-- A Popup for cropping -->
        <!-- You can replace it with the framework's Modal component -->
        <AppModalDefault :open="isShowModal">
            <template v-slot:title>
                <!-- <span class="text-base font-semibold leading-6 text-gray-900">
                    Cortar Imagem
                </span> -->
            </template>
            <template v-slot:label>
                <VuePictureCropper
                    :boxStyle="{
                        width: '100%',
                        height: '100%',
                        backgroundColor: '#f8f8f8',
                        margin: 'auto',
                    }"
                    :img="pic"
                    :options="{
                        viewMode: 1,
                        dragMode: 'crop',
                        aspectRatio: 16 / 16,
                    }"
                    @ready="ready"
            /></template>
            <template v-slot:buttons>
                <!-- <AppButton class="ml-4" @click="clear"> Limpar </AppButton>
                <AppButton class="ml-4" @click="reset"> Reiniciar </AppButton> -->
                <AppButton class="ml-4" @click="getResult"> Cortar </AppButton>
                <AppButton
                    textColor="gray-900"
                    bgColor="gray"
                    bgColorHover="white"
                    shadow=""
                    class="ml-4"
                    @click="isShowModal = false"
                >
                    Cancelar
                </AppButton>
            </template>
        </AppModalDefault>
    </div>
</template>

<script lang="ts" setup>
import { reactive, ref, computed, defineEmits } from "vue";
import VuePictureCropper, { cropper } from "vue-picture-cropper";
import { object } from "yup";
import AppButton from "../components/AppButton.vue";
import AppModalDefault from "../components/Modal/AppModalDefault.vue";

const props = defineProps({
    modelValue: {
        type: object,
        default: {
            dataURL: "",
            blobURL: "",
        },
    },
    buttonName: { type: String, default: "" },
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

const isShowModal = ref<boolean>(false);
const uploadInput = ref<HTMLInputElement | null>(null);
const pic = ref<string>("");
// const result = reactive({
//     dataURL: "",
//     blobURL: "",
// });

/**
 * Select the picture to be cropped
 */
function selectFile(e: Event) {
    // Reset last selection and results
    pic.value = "";
    // model.value.dataURL = "";
    // model.value.blobURL = "";

    // Get selected files
    const { files } = e.target as HTMLInputElement;
    if (!files || !files.length) return;

    // Convert to dataURL and pass to the cropper component
    const file = files[0];
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => {
        // Update the picture source of the `img` prop
        pic.value = String(reader.result);

        // Show the modal
        isShowModal.value = true;

        // Clear selected files of input element
        if (!uploadInput.value) return;
        uploadInput.value.value = "";
    };
}

/**
 * Get cropping results
 */
async function getResult() {
    if (!cropper) return;
    const base64 = cropper.getDataURL();
    const blob: Blob | null = await cropper.getBlob();
    if (!blob) return;

    const file = await cropper.getFile({
        fileName: "profile",
    });

    // console.log({ base64, blob, file });
    model.value.dataURL = base64;
    model.value.blobURL = URL.createObjectURL(blob);
    isShowModal.value = false;
}

/**
 * Clear the crop box
 */
function clear() {
    if (!cropper) return;
    cropper.clear();
}

/**
 * Reset the default cropping area
 */
function reset() {
    if (!cropper) return;
    cropper.reset();
}

/**
 * The ready event passed to Cropper.js
 */
function ready() {
    // console.log("Cropper is ready.");
}
</script>

<style scoped></style>
