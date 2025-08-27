<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import {
    PlusIcon,
    PencilSquareIcon,
    TrashIcon,
} from "@heroicons/vue/24/outline";
import Modal from "@/Components/Modal.vue";
import { ref } from "vue";

// Menerima props 'categories' yang dikirim dari controller
defineProps({
    categories: Array,
});

const confirmingCategoryDeletion = ref(false);
const form = useForm({});
const categoryToDelete = ref(null);

const confirmCategoryDeletion = (category) => {
    categoryToDelete.value = category;
    confirmingCategoryDeletion.value = true;
};

const deleteCategory = () => {
    form.delete(route("categories.destroy", categoryToDelete.value.id), {
        onSuccess: () => closeModal(),
    });
};

const closeModal = () => {
    confirmingCategoryDeletion.value = false;
    categoryToDelete.value = null;
};
</script>

<template>
    <Head title="Categories" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Daftar Kategori
                </h1>

                <Link
                    :href="route('categories.create')"
                    class="inline-flex items-center px-4 py-2 bg-primary-500 text-white rounded-md hover:bg-primary-600"
                >
                    <PlusIcon class="h-5 w-5 mr-2" />
                    Tambah Kategori
                </Link>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr
                                v-for="(category, index) in categories"
                                :key="category.id"
                            >
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ category.name }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                >
                                    <div
                                        class="flex items-center justify-end space-x-3"
                                    >
                                        <Link
                                            :href="
                                                route(
                                                    'categories.edit',
                                                    category.id
                                                )
                                            "
                                            class="text-primary-600 hover:text-primary-900"
                                        >
                                            <PencilSquareIcon class="h-5 w-5" />
                                        </Link>
                                        <button
                                            @click="
                                                confirmCategoryDeletion(
                                                    category
                                                )
                                            "
                                            class="text-red-600 hover:text-red-900"
                                        >
                                            <TrashIcon class="h-5 w-5" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <Modal :show="confirmingCategoryDeletion" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Apakah Anda yakin ingin menghapus kategori ini?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Kategori "{{ categoryToDelete ? categoryToDelete.name : "" }}"
                akan dihapus secara permanen.
            </p>

            <div class="mt-6 flex justify-end">
                <button
                    @click="closeModal"
                    class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50"
                >
                    Batal
                </button>

                <button
                    @click="deleteCategory"
                    :disabled="form.processing"
                    class="ml-3 inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 disabled:bg-gray-400"
                >
                    Hapus Kategori
                </button>
            </div>
        </div>
    </Modal>
</template>
