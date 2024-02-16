<script setup>
import { defineProps, defineEmits, ref, inject } from 'vue'
const props = defineProps(['url', 'data', 'label', 'id'])
const emits = defineEmits('onUpload', 'upload')
const id = ref()
const swal = inject('$swal')

const chooseFile = () => {
    id.value.click()
}

const uploadFile = (e) => {
    emits('onUpload', e)
}

</script>
<template>
<div class="file_upload">
    <label v-html="label" :for="props.id" class="mb-1" />
    <input
        type="file"
        :id="props.id"
        ref="id"
        @change="(e) => uploadFile(e)"
    />
    <div class="form-control text-secondary" :class="{'mb-2': props.data}" v-html="'Выберите файл для загрузки...'" @click="chooseFile" />
    <a v-if="props.data" :href="props.data" target="_blank" v-html="props.data" />
</div>
</template>