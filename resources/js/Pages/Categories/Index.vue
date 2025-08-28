<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { ref, watch } from "vue";

// PrimeVue & Services
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { useConfirm } from "primevue/useconfirm";
import { useAppToast } from "@/composables/useAppToast";
import Dialog from "primevue/dialog";
import InputText from "primevue/inputtext";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";

// Komponen Kustom Kita
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import InfoButton from "@/Components/InfoButton.vue";
import AppInputText from "@/Components/AppInputText.vue";

// PROPS DITERIMA DARI CONTROLLER
const props = defineProps({
    categories: Array,
});

// SERVICES
const page = usePage();
const confirm = useConfirm();
const { showSuccess } = useAppToast();

// STATE MANAGEMENT
const form = useForm({
    id: null,
    name: "",
});
const filters = ref({
    global: { value: null, matchMode: "contains" },
});
const isModalVisible = ref(false);
const modalMode = ref("add");

// LOGIC
watch(
    () => page.props.flash,
    (flash) => {
        if (flash && flash.success) {
            showSuccess(flash.success);
        }
    },
    { immediate: true }
);

const openAddModal = () => {
    form.reset();
    modalMode.value = "add";
    isModalVisible.value = true;
};

const openEditModal = (category) => {
    form.id = category.id;
    form.name = category.name;
    modalMode.value = "edit";
    isModalVisible.value = true;
};

const submit = () => {
    const onSuccess = () => {
        isModalVisible.value = false;
        form.reset();
    };

    if (modalMode.value === "add") {
        form.post(route("categories.store"), {
            preserveScroll: true,
            onSuccess,
        });
    } else {
        form.patch(route("categories.update", form.id), {
            preserveScroll: true,
            onSuccess,
        });
    }
};

const confirmDeleteCategory = (category) => {
    confirm.require({
        message: `Apakah Anda yakin ingin menghapus kategori "${category.name}"?`,
        header: "Konfirmasi Penghapusan",
        icon: "pi pi-info-circle",
        rejectClass: "p-button-secondary p-button-outlined",
        acceptClass: "p-button-danger",
        acceptLabel: "Hapus",
        rejectLabel: "Batal",
        accept: () => {
            form.delete(route("categories.destroy", category.id), {
                preserveScroll: true,
            });
        },
    });
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
                <PrimaryButton
                    @click="openAddModal"
                    label="Tambah Kategori"
                    icon="pi pi-plus"
                />
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <DataTable
                    :value="categories"
                    paginator
                    :rows="10"
                    v-model:filters="filters"
                    dataKey="id"
                    :globalFilterFields="['name']"
                >
                    <template #header>
                        <IconField iconPosition="left">
                            <InputIcon class="pi pi-search" />
                            <InputText
                                v-model="filters['global'].value"
                                placeholder="Cari kategori..."
                                class="w-full md:w-auto"
                            />
                        </IconField>
                    </template>

                    <Column field="name" header="Name" sortable></Column>

                    <Column header="Actions" style="width: 10rem">
                        <template #body="slotProps">
                            <div class="flex gap-2">
                                <InfoButton
                                    @click="openEditModal(slotProps.data)"
                                    icon="pi pi-pencil"
                                    v-tooltip="'Edit'"
                                />
                                <DangerButton
                                    @click="
                                        confirmDeleteCategory(slotProps.data)
                                    "
                                    icon="pi pi-trash"
                                    v-tooltip="'Delete'"
                                />
                            </div>
                        </template>
                    </Column>
                </DataTable>
            </div>
        </div>
    </AuthenticatedLayout>

    <Dialog
        v-model:visible="isModalVisible"
        :header="modalMode === 'add' ? 'Tambah Kategori Baru' : 'Edit Kategori'"
        modal
        :style="{ width: '30rem' }"
    >
        <form @submit.prevent="submit" class="mt-4">
            <AppInputText
                label="Nama Kategori"
                v-model="form.name"
                :error="form.errors.name"
            />
            <div class="flex justify-end gap-2 mt-6">
                <SecondaryButton
                    type="button"
                    label="Batal"
                    @click="isModalVisible = false"
                />
                <PrimaryButton
                    type="submit"
                    :label="modalMode === 'add' ? 'Simpan' : 'Update'"
                    :loading="form.processing"
                />
            </div>
        </form>
    </Dialog>
</template>
