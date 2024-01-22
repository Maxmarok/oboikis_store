<script setup>
import { defineProps } from 'vue'
const props = defineProps(['items'])
</script>
<template>
<a v-for="item in props.items" 
    v-if="props.items"
    :class="{
        'blue_color c_t1_span1': item.link,
        'pink_color c_t1_span2': !item.link,
    }" 
    :href="item.link"
>
    <span v-html="item.title" />
</a>
</template>