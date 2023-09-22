<script setup>

import { Swiper, SwiperSlide  } from 'swiper/vue';
import { Autoplay, Navigation, Scrollbar } from "swiper/modules";



import 'swiper/css';

import { gsap } from "gsap";

import 'swiper/css/scrollbar';
import "swiper/css/navigation";
// Import Swiper styles

//heroicons
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/24/solid";
import { onMounted, reactive, ref, watch } from 'vue';

const modules = reactive([Autoplay, Navigation, Scrollbar])

//references
const swipe = ref(null)

// const swiperSlide = useSwiperSlide();


// console.log();


// methods
const runForever = (evt) => {
    // console.log(evt);
    swipe.value = evt

    evt.slides.forEach((slide, index)=>{
        console.log('something');
        let letter = slide.querySelector(".title")
        let description = slide.querySelector(".subtitle")
        console.log(letter);
        console.log(description);
    //     let chars = SplitText.create(description, {type:"chars"})
    //     let tl = gsap.timeline({paused:true})
    //     tl.from(letter, {scale:0, opacity:0, ease:"back", duration:1})
    //     .from(chars.chars, {opacity:0, yPercent:50, stagger:0.02}, "-=0.5")
    //     slide.animation = tl
    })
}

const swiperActive = (evt) => {
    // console.log(evt);
    gsap.to(evt.slides[evt.activeIndex], {scale:1, opacity:1})
    gsap.to(evt.slides[evt.previousIndex], {opacity:0.3, scale:0.8})


    let titleActive = evt.slides[evt.activeIndex].children[0].children[1].children[0].children[1]
    let categoryActive = evt.slides[evt.activeIndex].children[0].children[1].children[0].children[0]

    let titlePrev = evt.slides[evt.previousIndex].children[0].children[1].children[0].children[1]
    let categoryPrev = evt.slides[evt.previousIndex].children[0].children[1].children[0].children[0]

    titleActive.addClass('animate__animated', 'animate__fadeInDownBig')
    titlePrev.addClass('animate__animated', 'animate__fadeInDownBig')

    // evt.slides[evt.activeIndex].addClass('animate__animated', 'animate__fadeInDownBig')
    // evt.slides[evt.activeIndex].removeClass('animate__animated', 'animate__fadeInDownBig', 'delay4')

    console.log(evt.slides[evt.activeIndex].children[0].children[1].children[0]);

}


// refs
const items = ref([])

onMounted(() => {

    items.value.push(
        {
        id: 1,
        category: 'Energy & Natural Resources',
        title: 'New barriers, new solutions',
        src: './images/construction.jpg'
        },
        {
        id: 2,
        category: 'Paper & Packaging',
        title: "Unpack the power of sustainable packaging",
        src: './images/paketim.jpg'
        },
        {
        id: 3,
        category: 'Climate Change',
        title: 'How to Navigate the Transition to Sustainable Metals and Chemicals',
        src: './images/climate.jpg'
        },
        {
        id: 4,
        category: 'Media',
        title: "The New Era of Immersive Entertainment",
        src: './images/imersive.jpg'
        },
    )

    // runForever()
})

watch(swipe, (val) => {
    // console.log(val);
    // val.slides.forEach((slide, index)=>{
    //     console.log('something');
    //     let letter = slide.querySelector(".title")
    //     let description = slide.querySelector(".subtitle")
    //     console.log(letter);
    //     console.log(description);
    //     let chars = SplitText.create(description, {type:"chars"})
    //     let tl = gsap.timeline({paused:true})
    //     tl.from(letter, {scale:0, opacity:0, ease:"back", duration:1})
    //     .from(chars.chars, {opacity:0, yPercent:50, stagger:0.02}, "-=0.5")
    //     slide.animation = tl
    // })


}, {deep: true})

</script>

<template>
        <div class="relative h-[60vh] w-full px-0 py-5 type">
            <!-- :autoplay="true" -->
            <!-- :autoplay="{
            delay: 4000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        }" -->
        <swiper
        @slideChange="swiperActive"
        @swiper="runForever"
        :slides-per-view="1"
        :space-between="50"
        :loop="true"
        class="w-full h-full"
        :navigation="{
            nextEl: '.left',
            prevEl: '.right',
        }"
        :modules="modules">
            <swiper-slide
            data-swiper-autoplay="5000"
            v-for="item in items" :key="item.id"
            class="w-full font-sans text-base text-slate-800">
                <div class="relative grid w-full h-full grid-cols-12 gap-x-8">
                    <img :src="item.src" class="absolute w-full col-span-12 object-fit h-hull">
                    <div class="z-40 flex items-center h-full col-span-3 col-start-2">
                        <div class="p-1 my-auto animates bg-slate-50">
                            <!-- <h1 class="mb-4 category text-slate-800 animate__animated animate__fadeInDownBig"> -->
                            <h1 class="mb-4 category text-slate-800 animate__animated animate__fadeInDownBig">
                                {{ item.category }}
                            </h1>
                            <!-- <h2 class="w-11/12 text-3xl title text-slate-500 animate__animated animate__fadeInDownBig delay4"> -->
                            <h2 class="w-11/12 text-3xl title text-slate-500 animate__animated animate__fadeInDownBig delay4">
                                {{ item.title }}
                            </h2>
                        </div>
                    </div>
                </div>
            </swiper-slide>
        </swiper>
        <div class="absolute left-0 hidden w-full px-4 top-4">
            <ChevronLeftIcon class="cursor-pointer w-7 h-7 left" />
            <div class="col-span-3"></div>
            <ChevronRightIcon class="cursor-pointer w-7 h-7 right justify-self-end" />
        </div>
    </div>
</template>

<style>
   .delay1 {
      animation-delay: 0.1s;
    }
    .delay2 {
      animation-delay: 0.2s;
    }
    .delay3 {
      animation-delay: 0.3s;
    }
    .delay4 {
      animation-delay: 0.4s;
    }

    .swiper-slide-active .animate {
        animation-duration: 2s;
        animation-fill-mode: both;
        -webkit-animation-duration: 2s;
        -webkit-animation-fill-mode: both;
    }

    .swiper-slide-active .fadeInRight {
        animation-delay: 0.4s;
        -webkit-animation-name: fadeInRight;
        animation-name: fadeInRight;
    }

    .ml1 .letter {
        display: inline-block;
        line-height: 1em;
    }

    .ml1 .text-wrapper {
        position: relative;
        display: inline-block;
        padding-top: 0.1em;
        padding-right: 0.05em;
        padding-bottom: 0.15em;
    }

    .ml1 .line {
        opacity: 0;
        position: absolute;
        left: 0;
        height: 3px;
        width: 100%;
        background-color: #fff;
        transform-origin: 0 0;
    }

    .ml1 .line1 { top: 0; }
    .ml1 .line2 { bottom: 0; }
</style>
