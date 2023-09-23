<script setup>
import { onMounted } from "@vue/runtime-core";

const prop = defineProps({
    item: Object
})

onMounted(() => {
    prop
})

// onMounted
</script>
<template>

    <div class="relative w-full p-10 border border-solid rounded-md border-slate-100 bg-first-gray">
        <div class="absolute px-3 -mt-8 -ml-2 rounded-lg bg-second-gray">
            <span class="text-xs">
                {{ item.category }}
            </span>
        </div>
        <div class="relative grid w-full h-full grid-cols-6 gap-x-5">
            <div class="col-span-4 ">
                <p class="w-4/5 h-full pb-8 font-sans text-sm text-third-gray">
                    {{ item.title }}
                </p>
                <div class="absolute bottom-0 flex">
                    <span class="text-sm font-thin font-display text-forth-gray">
                        {{ item.date }}
                    </span>
                </div>
            </div>
            <img :src="prop.item.src" class="object-cover w-full h-24 col-span-2 rounded-md " alt="">
        </div>
    </div>

</template>
