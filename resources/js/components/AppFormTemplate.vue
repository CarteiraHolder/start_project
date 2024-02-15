<template>
    <div class="space-y-12 mt-6">
        <div
            :class="[
                'border-b border-gray-900/10',
                isSlideOver ? 'pb-8' : 'pb-12',
            ]"
        >
            <div
                :class="[
                    'grid grid-cols-1 gap-x-6 gap-y-2',
                    isSlideOver ? '' : 'sm:grid-cols-12',
                ]"
            >
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps({
    isSlideOver: { type: Boolean, default: false },
});
</script>
