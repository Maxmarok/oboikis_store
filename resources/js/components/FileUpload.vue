<script setup>
import { defineProps, defineEmits, ref } from 'vue'
const props = defineProps(['url', 'data', 'label', 'id'])
const emits = defineEmits('onUpload')
const id = ref();

const chooseFile = () => {
    console.log(id)
    id.value.click()
}
</script>
<template>
<div class="file_upload">
    <label v-html="label" :for="props.id" />
    <input
        type="file"
        :id="props.id"
        ref="id"
    />
    <div class="form-control" v-html="props.data" @click="chooseFile" />
</div>
</template>