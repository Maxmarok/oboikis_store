<script setup>
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import Item from '@js/components/Item.vue'
const props = defineProps(['items', 'breakpoints'])
</script>
<template>
<carousel class="owl-carousel owl-theme slider1 screen3_cards" ref="carousel" :wrapAround="true" :breakpoints="props.breakpoints">
    <slide v-for="slide in props.items" :key="slide.id">
        <Item :item="slide"/>
    </slide>

    <template #addons>
        <navigation />
        <pagination />
    </template>
</carousel>
</template>