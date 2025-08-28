<script setup>
import Dialog from "primevue/dialog";

const props = defineProps({
    show: Boolean,
    header: String,
});

const emit = defineEmits(["close"]);

const onHide = () => {
    emit("close");
};
</script>

<template>
    <Dialog
        :visible="show"
        @update:visible="onHide"
        modal
        :header="header"
        :style="{ width: '25rem' }"
    >
        <slot />
    </Dialog>
</template>
