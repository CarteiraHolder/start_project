<template>
    <div id="bg_loading" class="bg_loading flex justify-center" :style="show">
        <div style="position: absolute; top: 40%">
            <div class="flex justify-center">
                <SelfBuildingSquareSpinner
                    :animation-duration="4000"
                    :size="100"
                    :color="'#081466'"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
import loading from "../store/Loading";
import { SelfBuildingSquareSpinner } from "epic-spinners";

const show = computed(() =>
    loading.state.loading ? "" : "display:none !important;"
);
</script>

<style>
.bg_loading {
    width: 100%;
    height: 110%;
    position: fixed;
    top: 0;
    left: 0;
    background: #cbc8ee;
    opacity: 0.8;
    z-index: 9999;
}
</style>
