<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

import { onBeforeMount, onMounted, ref } from 'vue';


// props
const prop = defineProps({
    settings: Array
})

// refs
const show = ref(false)

const form = useForm({
    email: null,
    address: null,
})

// form


// methods


// hooks
onBeforeMount(() => {
    prop.settings.forEach(element => {
        form.address = element.address
        form.email = element.email
    });
})

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
                    <div class="max-h-[30vh] h-full w-full">
                        <form @submit.prevent="form.post('/login')">
                            <div class="grid grid-cols-2 gap-x-2">
                                <div>
                                    <input type="text" v-model="form.email">
                                    <div v-if="form.errors.email">{{ form.errors.email }}</div>
                                </div>
                                <div>
                                    <input type="text" v-model="form.address">
                                    <div v-if="form.errors.address">{{ form.errors.address }}</div>
                                </div>
                                <button type="submit" :disabled="form.processing">Login</button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>

