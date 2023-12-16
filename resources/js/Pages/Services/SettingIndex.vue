<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useInertia } from "formkit-addon-inertia";

import { onMounted, ref } from 'vue';

// heroicons

// import DynamicHeroIcons from '@/Components/DynamicHeroIcons.vue';

// props
const prop = defineProps({
    services: Array
})

// refs
const show = ref(false)


// methods
const submitRequest = (flds, node) => {
    useInertia(node).post(route('services.store'), flds)
    show.value = false
}




// hooks
onMounted(() => {})

// watch

</script>

<template>
    <Head title="Services" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Services
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-3 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">


                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>

