<template>
    <div class="m-8">
        <h1>useBattery</h1>
        <p>charging: {{ charging }}</p>
        <p>chargingTime: {{ chargingTime }}</p>
        <p>dischargingTime: {{ dischargingTime }}</p>
        <p>level: {{ level * 100 }}%</p>

        <h1>useGeolocation</h1>
        <p>altitude: {{ coords.altitude }}</p>
        <p>longitude: {{ coords.longitude }}</p>
        <p>latitude: {{ coords.latitude }}</p>
        <p>locatedAt: {{ locatedAt }}</p>
        <p>error: {{ error?.code }}</p>
        <p>resume: {{ resume }}</p>
        <p>pause: {{ pause }}</p>

        <h1>useCamera</h1>
        <button style="margin-bottom: 40px" @click="change()">
            Change camera
        </button>
        <Camera
            :resolution="{ width: 375, height: 812 }"
            ref="camera"
            autoplay
        ></Camera>
    </div>
</template>

<script setup lang="ts">
import { ref, computed } from "vue";
import Camera from "simple-vue-camera";
import { useBattery } from "@vueuse/core";
import { useGeolocation } from "@vueuse/core";

const { charging, chargingTime, dischargingTime, level } = useBattery();
const { coords, locatedAt, error, resume, pause } = useGeolocation();

const camera = ref<InstanceType<typeof Camera>>();

const blob = computed(
    async () => await camera.value?.snapshot({ width: 1920, height: 1080 })
);

// Use camera reference to call functions
const snapshot = async () => {
    const blob = await camera.value?.snapshot();

    // To show the screenshot with an image tag, create a url
    const url = URL.createObjectURL(blob);
};

const index = ref(0);
async function change() {
    const mediaDevices = await navigator.mediaDevices.enumerateDevices();
    const videoinputs = mediaDevices.filter((el) => el.kind == "videoinput");
    index.value++;
    index.value = index.value > videoinputs.length - 1 ? 0 : index.value;
    camera.value?.changeCamera(videoinputs[index.value].deviceId);
}
</script>

<style></style>
