<script setup>
import { defineProps, onMounted, ref, watch } from 'vue'
const props = defineProps(['items'])
const active_items = ref()
const items = ref()

const getItems = (list) => {
    active_items.value = list.filter(x => x.link !== null)
    items.value = list.filter(x => x.link === null)
}

watch(() => props.items, function() {
  if(props.items !== null) {
    getItems(props.items)
  }
});

onMounted(() => getItems(props.items))
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