<script setup>
import Button from "primevue/button";

defineProps({
    label: String,
    icon: String,
    loading: Boolean,
    type: {
        type: String,
        default: "button",
    },
});
</script>

<template>
    <Button
        :label="label"
        :icon="icon"
        :loading="loading"
        :type="type"
        class="bg-primary-500 text-white border-primary-500 hover:bg-primary-600"
    >
        <slot />
    </Button>
</template>
