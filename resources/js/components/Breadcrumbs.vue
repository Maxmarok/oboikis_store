<script setup>
import { defineProps, ref, watch } from 'vue'
const props = defineProps(['items'])
const active_items = ref()
const items = ref()

watch(() => props.items, function() {
  if(props.items !== null) {
    active_items.value = props.items ? props.items.filter(x => x.link !== null) : null
    items.value = props.items ? props.items.filter(x => x.link === null) : null
  } else {
    active_items.value = null
    items.value = null
  }
});

console.log(props)
</script>
<template>
<router-link 
    v-if="active_items"
    v-for="item in active_items"
    class="blue_color c_t1_span1"
    :to="item.link"
>
    <span v-html="item.title" />
</router-link>
<span class="pink_color c_t1_span2" v-if="items" v-for="item in items" v-html="item.title" />
</template>