<script setup>
import Button from "primevue/button";

defineProps({
    label: String,
    icon: String,
    loading: Boolean,
});
</script>

<template>
    <Button :label="label" :icon="icon" :loading="loading" severity="danger">
        <slot />
    </Button>
</template>
