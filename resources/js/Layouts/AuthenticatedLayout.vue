<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
import {
    HomeIcon,
    TagIcon,
    BuildingOffice2Icon,
    ArchiveBoxIcon,
} from "@heroicons/vue/24/outline";

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="h-screen flex bg-gray-100">
        <aside class="w-64 flex-shrink-0 bg-white border-r">
            <div class="h-16 flex items-center justify-center border-b">
                <Link :href="route('dashboard')">
                    <h1 class="text-2xl font-bold text-gray-800">Zentory</h1>
                </Link>
            </div>
            <nav class="mt-4">
                <NavLink
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                >
                    <HomeIcon class="h-5 w-5 mr-3" />
                    Dashboard
                </NavLink>
                <NavLink
                    :href="route('categories.index')"
                    :active="route().current('categories.*')"
                >
                    <TagIcon class="h-5 w-5 mr-3" />
                    Categories
                </NavLink>
                <NavLink
                    :href="route('suppliers.index')"
                    :active="route().current('suppliers.*')"
                >
                    <BuildingOffice2Icon class="h-5 w-5 mr-3" />
                    Suppliers
                </NavLink>
                <NavLink
                    :href="route('products.index')"
                    :active="route().current('products.*')"
                >
                    <ArchiveBoxIcon class="h-5 w-5 mr-3" />
                    Products
                </NavLink>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white border-b">
                <div
                    class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-end"
                >
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <div class="ms-3 relative">
                            <span class="inline-flex rounded-md">
                                <button
                                    type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                >
                                    {{ $page.props.auth.user.name }}
                                    <svg
                                        class="ms-2 -me-0.5 h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </header>

            <main
                class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6"
            >
                <slot />
            </main>
        </div>
    </div>
</template>

<style scoped>
/* We can add specific styles here later if needed */
</style>
