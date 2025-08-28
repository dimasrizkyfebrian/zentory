<script setup>
import InputText from "primevue/inputtext";

const props = defineProps({
    modelValue: String,
    label: String,
    error: String,
    id: {
        type: String,
        default: () => `input-${Math.random().toString(36).substr(2, 9)}`,
    },
});

const emit = defineEmits(["update:modelValue"]);
</script>

<template>
    <div class="flex flex-col gap-2">
        <label :for="id">{{ label }}</label>
        <InputText
            :id="id"
            :value="modelValue"
            @update:modelValue="emit('update:modelValue', $event)"
            :invalid="!!error"
        />
        <small class="p-error" v-if="error">{{ error }}</small>
    </div>
</template>
