<template>
    <!-- Static sidebar for desktop -->
    <div
        class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col"
    >
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div
            class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 pb-4"
        >
            <div class="flex h-16 shrink-0 items-center">
                <img
                    class="h-10 w-auto"
                    src="@/assets/image/logo.svg"
                    alt="Logo"
                />
            </div>
            <NavigationItem :navigation="navigation"></NavigationItem>
        </div>
    </div>
</template>

<script setup>
import NavigationItem from "./NavigationItem.vue";
const props = defineProps({
    navigation: { type: Array },
});
</script>

<style></style>
