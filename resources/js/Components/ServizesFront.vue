<script setup>
import { computed, onMounted } from "vue";

import anime from 'animejs'

const prop = defineProps({
    item: Object
})

const comp = computed(() => {
    return {
        title: prop.item.title,
        short_description: prop.item.short_description,
        media: prop.item.media,
        area: prop.item.area,
        opened: false,
    }
})

// methods
const loading = (comp, evt) => {
    const targets = evt.target.parentNode.childNodes[0]
    let wrapperStyle = evt.target.parentNode.childNodes[0].style;
    if (comp.opened) {
      anime({
        targets,
        height: 0,
        opacity: [1, 0],
        duration: 400,
        easing: 'easeOutQuad',
        complete() {
            comp.opened = false;
            wrapperStyle.display = '';
        }
      });
    } else {
        comp.opened = true;
        wrapperStyle.display = 'block';
        wrapperStyle.height = '0px';
        anime({
            targets,
            height: el => el.scrollHeight,
            opacity: [0, 1],
            duration: 400,
            easing: 'easeOutCubic'
        });
    }
}

onMounted(() => {})
</script>
<template>
        <!-- <div class="relative w-full border border-solid rounded-md text-gray-forth">
            <img :src="comp.media" v-if="comp.media" class="object-cover w-full h-44" alt="">
            <p class="relative z-40 px-5 py-1 -mt-8 border-t border-b bg-first-gray w-fit text-start">
                {{ comp.area }}
            </p>
            <div class="relative grid w-full h-full grid-cols-6 p-10 gap-x-5">
                <div class="col-span-6">
                    <p class="pb-8 font-sans text-sm wrapper">
                        {{ comp.short_description }}
                    </p>
                    <p class="pb-0 mt-2 text-xl uppercase cursor-pointer font-display"
                    @click="loading(comp, $event)">
                        {{ comp.title }}
                    </p>
                </div>
            </div>
        </div> -->
        <div class="relative w-full border-2 border-solid rounded-md min-h-44 text-gray-forth border-mbyll">
            <img :src="comp.media" v-if="comp.media" class="absolute object-cover w-full h-44" alt="">
            <div class="relative z-40 w-2/3 bg-slight">
                <p class="relative px-5 py-1 border-t border-b bg-first-gray w-fit text-start">
                    {{ comp.area }}
                </p>
                <div class="relative grid w-full h-full grid-cols-6 p-2 gap-x-5">
                    <div class="col-span-6">
                        <p class="pb-8 font-sans text-sm wrapper">
                            {{ comp.short_description }}
                        </p>
                        <p class="pb-0 mt-2 text-xl uppercase cursor-pointer font-display"
                        @click="loading(comp, $event)">
                            {{ comp.title }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
</template>

<style>
.wrapper{
    display: none;
}
</style>
