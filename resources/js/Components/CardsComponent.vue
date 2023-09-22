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

    <div class="relative w-full p-10 border border-solid rounded-md border-slate-100 bg-gradient-to-r from-slate-500 to-transparent">
        <div class="absolute px-3 -mt-8 -ml-2 rounded-lg bg-slate-300">
            <span class="text-xs ">
                {{ item.category }}
            </span>
        </div>
        <div class="relative grid w-full h-full grid-cols-6 gap-x-5">
            <div class="col-span-4 ">
                <p class="w-4/5 h-full pb-8 font-sans text-sm text-slate-100">
                    {{ item.title }}
                </p>
                <div class="absolute bottom-0 flex">
                    <span class="text-sm font-thin font-display text-slate-100">
                        {{ item.date }}
                    </span>
                </div>
            </div>
            <img :src="prop.item.src" class="object-cover w-full h-24 col-span-2 rounded-md " alt="">
        </div>
    </div>

</template>
