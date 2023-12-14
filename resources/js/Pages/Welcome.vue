<script setup>
import { Head, Link } from '@inertiajs/vue3';

import NewsComponent from "@/Components/NewsComponent.vue";
import CardsComponent from "@/Components/CardsComponent.vue";
import BigSlider from "@/Components/BigSlider.vue";
import { onMounted, ref } from 'vue';
import DynamicHeroIcons from '@/Components/DynamicHeroIcons.vue';

// import BigBall from "@/Components/BigBall.vue";
import ServizesFront from "@/Components/ServizesFront.vue";
import GuestLayout from '@/Layouts/GuestLayout.vue';

// props
const prop = defineProps({
    articles: Array,
    servizes: Array
})

// refs
const items = ref([])
const news = ref([])

const itemsString = ref('')

// hooks
onMounted(() => {

    items.value.push(
        {
        id: 1,
        category: 'Turismo',
        title: 'Vlora Marina, Il Progetto Più Importante Per Il Turismo Marittimo Del Paese',
        date: 'Tuesday January  3rd, 2023',
        src: './images/porto-turistico-valona-1.webp'
        },
        {
        id: 2,
        category: 'Video',
        title: "Made in Albania, Giornata di studio sul tema L'Albania di Skanderbeg in Italia",
        date: 'Tuesday January  3rd, 2023',
        src: './images/Made-in-Albania.webp'
        },
        {
        id: 3,
        category: 'Video',
        title: 'Conviene investire in Albania? La risposta di Italian Network',
        date: 'Tuesday January  3rd, 2023',
        src: './images/Laera-Intervista.webp'
        },
        {
        id: 4,
        category: 'Economia',
        title: "(Italiano) Promuovere l'integrazione ",
        date: 'Tuesday January  3rd, 2023',
        src: './images/Promuovere-lintegrazione-economica-nei-Balcani-occidentali.webp'
        },
    )

    news.value = prop.articles.map(el => {
        return {
            id: el.id,
            title: el.title,
            href: el.url,
            data: el.data,
        }
    })


  itemsString.value = items.value.length.toString()

//   GuestLayout


})



</script>

<template>
    <Head title="Benvenuti" />

    <div class="w-screen overflow-x-hidden">
            <div class="grid w-full grid-cols-12 gap-2 mx-auto bg-slight">
                <p class="col-span-4 col-start-2 my-4 ml-8 text-sm font-medium text-ebony">
                    <DynamicHeroIcons name="envelope" :size="5" class="inline" />
                    <span class="">
                        antonio.barcela@something.com
                    </span>
                </p>
            </div>
            <hr class="border border-ebony drop-shadow-md">
            <!-- <div class="w-full pt-8 mx-auto my-auto overflow-x-hidden bg-gradient-to-t from-hap from-0% via-mbyll via-20% to-ebony to-75%"> -->
            <div class="w-full pt-8 mx-auto my-auto overflow-x-hidden bg-gradient-to-t from-hap from-0% to-slight to-75%">
                <div
                class="container mx-auto font-sans">
                    <div class="w-full">
                        <div class="flex flex-row">
                            <div class="basis-1/12">
                                <img class="w-2/3 col-span-3" :src="'/images/bsrlogo.svg'" alt="">
                            </div>
                            <div class="grid grid-cols-12 basis-10/12 text-ebony">
                                <p class="col-start-2 my-auto">menu one</p>
                                <p class="my-auto">menu one</p>
                                <p class="my-auto">menu one</p>
                                <p class="my-auto">menu one</p>
                                <p class="my-auto">menu one</p>
                            </div>
                        </div>

                    </div>
                    <div class="relative w-full mb-10">
                        <BigSlider />
                    </div>
                    <div class="relative w-full mb-10">

                    </div>
                    <div class="relative w-full">
                        <p class="absolute top-0 left-0">
                            Novita
                        </p>
                        <NewsComponent class="py-3" :news="news" />
                    </div>

                    <hr class="w-10/12 mx-auto mt-5 border-4">
                </div>
            </div>
            <div class="w-full py-10 mx-auto my-auto">
                <div
                class="container mx-auto font-sans">

                    <div class="grid content-center w-2/3 grid-cols-2 gap-8 mx-auto h-fit">
                        <ServizesFront v-for="item in servizes" :key="item.id" :item="item" />
                    </div>
                </div>
            </div>
            <div class="w-full py-10 mx-auto my-auto">
                <div
                class="container mx-auto font-sans">
                    <div class="grid content-center w-2/3 grid-cols-2 gap-8 mx-auto h-fit">
                        <CardsComponent class="drop-shadow-lg" v-for="item in items" :key="item.id" :item="item" />
                    </div>
                </div>
            </div>
    </div>



</template>


