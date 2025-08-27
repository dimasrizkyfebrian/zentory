<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps(["href", "active"]);

const classes = computed(() =>
    props.active
        ? "block py-2.5 px-4 bg-primary-100 text-primary-700 font-semibold border-l-4 border-primary-500"
        : "block py-2.5 px-4 text-gray-600 hover:bg-gray-100"
);
</script>

<template>
    <Link :href="href" :class="classes" class="flex items-center">
        <slot />
    </Link>
</template>
