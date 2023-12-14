<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useInertia } from "formkit-addon-inertia";
// quill editor
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
// modal
import Modal from "@/Components/Modal.vue";
import { onMounted, reactive, ref } from 'vue';

import VueCropper from 'vue-cropperjs';
import 'cropperjs/dist/cropper.css';

// heroicons
import { XCircleIcon } from '@heroicons/vue/24/outline';

// import DynamicHeroIcons from '@/Components/DynamicHeroIcons.vue';

// props
const prop = defineProps({
    services: Array
})

// refs
const show = ref(false)

const editor = ref(null)
const content = ref(null)

const showCropper = ref(false)

const optionquill = reactive({
    modules: {
        toolbar: ['bold', 'italic', 'underline']
    },
    placeholder: 'Write author bio...',
    readOnly: false,
    scrollingContainer: 'html',
    theme: 'snow'
})

const number = ref(false)

// methods
const submitRequest = (flds, node) => {
    useInertia(node).post(route('services.store'), flds)
    show.value = false
}

const changedContentEn = (evt) => {
    content.value = JSON.stringify(evt)
}

const handleFileChange = (ev) => {
    console.log(ev);
}



// hooks
onMounted(() => {
    setTimeout(() => {
        number.value = true
    }, 100)
})

// watch
// watch(editor, (val) => {
//     // console.log(val.getEditor());
//     // console.log(val.getContents());
//     // console.log(number.value === true && val.getEditor());
//     // if (number.value === true && val.getEditor()) {
//     //     editor.value.getQuill().setContents(JSON.parse(textArea.teaser_al), 'silent')
//     // }
// }, {immediate: true, deep: true})

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
                    <div class="w-full">
                        <button class="w-1/3 mb-10 border rounded-md" @click="show = !show">
                            Crea Servizio
                        </button>
                    </div>
                    <div class="grid grid-cols-6 px-5 gap-x-4 gap-y-2"
                    v-for="service in services"
                    :key="service.id">
                        <div class="col-span-3">
                            {{ service.title }}
                        </div>
                        <div>
                            <img v-if="service.media" class="w-7" :src="service.media" alt="">
                        </div>
                        <div class="col-span-2">
                            <!-- <button @click="">

                            </button> -->
                        </div>
                        <!-- div -->
                    </div>

                </div>
            </div>
        </div>
        <Modal :max-width="'7xl'" :show="show">
            <div class="w-full h-[80vh]">
                <div class="ml-auto w-36 mt-7">
                    <XCircleIcon class="mx-auto text-gray-400 cursor-pointer w-11 h-11"
                    @click="show = false" />
                </div>
                <div class="w-full mx-auto px-11 mt-11 h-4/5">
                    <p class="flex w-full mb-3 -mt-8 text-lg font-semibold uppercase">
                        Crea un servizio
                    </p>
                    <div class="relative w-full h-full">
                        <FormKit
                        ref="formacat"
                        type="form"
                        :actions="false"
                        @submit="submitRequest">
                        <div class="grid w-full h-full grid-cols-2 gap-3 mt-16">
                            <div class="grid grid-2 gap-x-4">
                                <FormKit
                                type="text"
                                name="title"
                                :classes="{
                                    inner: '$reset shadow-none',
                                    wrapper: '$reset w-full border-0',
                                    input: '$reset bg-slate-50 w-full rounded border-b-2 border-t-transparent border-r-transparent border-l-transparent',
                                    label: '$reset text-base font-light w-full flex mb-0'
                                }"
                                label="Nome del servizio" />
                                <FormKit
                                type="text"
                                name="area"
                                :classes="{
                                    inner: '$reset shadow-none',
                                    wrapper: '$reset w-full border-0',
                                    input: '$reset bg-slate-50 w-full rounded border-b-2 border-t-transparent border-r-transparent border-l-transparent',
                                    label: '$reset text-base font-light w-full flex mb-0'
                                }"
                                label="Area del servizio" />
                                <FormKit
                                type="textarea"
                                rows="5"
                                name="short_description"
                                :classes="{
                                    inner: '$reset shadow-none',
                                    wrapper: '$reset w-full border-0',
                                    input: '$reset bg-slate-50 w-full rounded border-b-2 border-t-transparent border-r-transparent border-l-transparent',
                                    label: '$reset text-base font-light w-full flex mb-0'
                                }"
                                label="Descrizione del servizio" />
                            </div>
                            <div class="relative grid grid-2 gap-x-4">
                                <FormKit
                                type="file"
                                @change="handleFileChange"
                                name="fileUpload"
                                label="Foto del servizio"
                                multiple="false"
                                accept=".png,.jpg,.jpeg"
                                :classes="{
                                    inner: '$reset shadow-none',
                                    wrapper: '$reset w-full border-1',
                                    input: '$reset block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 file:bg-transparent file:border-0 file:bg-gray-100 file:mr-4 file:py-3 file:px-4 dark:file:bg-gray-700 dark:file:text-gray-400',
                                    label: '$reset text-base font-light w-full flex mb-0',
                                    noFiles: '$reset hidden',
                                    fileName: '$reset hidden',
                                    fileRemove: '$reset absolute top-10 right-3 text-xs'
                                }" />
                                <vue-cropper
                                v-if="showCropper"
                                ref="cropper"
                                :src="imageSrc"
                                :aspect-ratio="1"
                                :view-mode="1"
                                :drag-mode="'crop'"
                                :background="true"
                                :rotatable="true"
                                :guides="true"
                                :container-style="{ width: '100%', height: '400px' }"
                                :img-style="{ width: '100%', height: '100%' }"
                                ></vue-cropper>

                                <FormKit type="hidden" name="description" v-model="content" />
                                <QuillEditor
                                v-if="number"
                                ref="editor"
                                :options="optionquill"
                                @update:content="changedContentEn($event)"
                                @focus="optionquill.placeholder = ''" />
                            </div>
                        </div>
                        <div class="absolute right-0 grid w-1/2 grid-cols-2 gap-x-4 bottom-28 justify-items-end">

                        <FormKit
                        type="button"
                        @click="show = false"
                        :classes="{
                            input: '$reset bg-gray-400 px-4 py-3 mx-auto font-light bg-gray-400 rounded-md text-slate-50',
                        }" >
                        ANNULLA
                        </FormKit>
                        <FormKit
                        :classes="{
                            input: '$reset px-4 py-3 mt-auto font-light bg-blue-600 rounded-md text-slate-50',
                        }"
                        type="submit"
                        label="SALVA" />
                        </div>
                        </FormKit>
                    </div>
                    <!-- // mbyllet -->
                    <!-- </div> -->
                </div>
        </div>

        </Modal>

    </AuthenticatedLayout>
</template>
<style>
.ql-container {
    height: 180px !important;
    max-height: 180px;
}
</style>
