<script setup>
import { onMounted, reactive } from "@vue/runtime-core";
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay, Navigation } from "swiper/modules";
import "swiper/css/navigation";
// Import Swiper styles
import 'swiper/css';

//heroicons
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/24/solid";

const modules = reactive([Autoplay, Navigation])

const prop = defineProps({
    news: Array
})

onMounted(() => {
    Swiper, SwiperSlide
    // prop
    prop, modules
    // console.log(prop.news);
    ChevronLeftIcon, ChevronRightIcon
})
</script>
<template>
    <!-- <div class="relative w-full px-0 shadow-inner rounded-lg bg-gradient-to-t from-slate-500 from-10% to-slate-50 to-35% py-5"> -->
    <div class="relative w-full px-0 py-5 rounded-lg shadow-inner bg-first-gray drop-shadow-lg">
        <swiper
        :slides-per-view="1"
        :space-between="50"
        :loop="true"
        class="w-4/5"
        :autoplay="true"
        :navigation="{
            nextEl: '.left',
            prevEl: '.right',
        }"
        :modules="modules">
            <swiper-slide
            data-swiper-autoplay="5000"
            v-for="notizia in prop.news" :key="notizia.id"
            class="w-full font-sans text-base text-forth-gray">
                <div class="grid w-full grid-cols-12 gap-x-8">
                    <div class="col-span-1 my-auto">
                        <p class="px-3 py-.5 text-sm font-display border rounded-md w-fit border-blue-950">
                            {{ notizia.data }}
                        </p>
                    </div>
                    <div class="col-span-11 my-auto ml-10">
                        <a :href="notizia.href" class="w-full">
                            {{ notizia.title }}
                        </a>
                    </div>
                </div>
            </swiper-slide>
        </swiper>
        <div class="absolute left-0 grid w-full grid-cols-5 px-4 justify-items-stretch top-4">
            <ChevronLeftIcon class="cursor-pointer w-7 h-7 left" />
            <div class="col-span-3"></div>
            <ChevronRightIcon class="cursor-pointer w-7 h-7 right justify-self-end" />
        </div>
    </div>
</template>

<style scoped>
/* .swiper-button-prev {
    margin-left: -3rem;
} */
</style>
