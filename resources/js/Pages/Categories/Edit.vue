<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

// Menerima props 'category' yang dikirim dari controller
const props = defineProps({
    category: Object,
});

// Inisialisasi form dengan data yang sudah ada
const form = useForm({
    name: props.category.name,
});

// Fungsi untuk submit form update
const submit = () => {
    form.put(route("categories.update", props.category.id));
};
</script>

<template>
    <Head title="Edit Kategori" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">
                Edit Kategori: {{ category.name }}
            </h1>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form @submit.prevent="submit">
                        <div>
                            <label
                                for="name"
                                class="block text-sm font-medium text-gray-700"
                                >Nama Kategori</label
                            >
                            <input
                                type="text"
                                v-model="form.name"
                                id="name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                                required
                            />
                            <div
                                v-if="form.errors.name"
                                class="text-sm text-red-600 mt-1"
                            >
                                {{ form.errors.name }}
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-end">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="px-4 py-2 bg-primary-500 text-white rounded-md hover:bg-primary-600 disabled:bg-gray-400"
                            >
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
