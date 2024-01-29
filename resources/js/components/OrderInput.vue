<script setup>
import { defineProps, defineEmits } from 'vue'
const emits = defineEmits(['change'])
const props = defineProps(['name', 'placeholder', 'required_text', 'errors', 'value'])

const onChange = (e) => {
    emits('change', e.target.value)
}
</script>
<template>
<div class="d-flex flex-column mb-3">
    <div class="reciever_block_body_text1 d-flex justify-content-between">
        <div><span class="reciever_block_text_bold blue_color" v-html="props.name" /><span class="pink_color"> *</span></div>
        <div class="reciever_block_body_text1_italic" v-if="props.required_text"><span class="pink_color">*</span><span class="blue_color"> поля, обязательные к заполнению</span></div>
    </div>
    <input class="reciever_block_input bg_white mt-1 blue_color" :class="{'s3_b_pink': props.errors, 's3_b_blue': !props.errors}" type="text" :placeholder="props.placeholder" :value="props.value" @input="(e) => onChange(e)">
    <div class="invalid-feedback" v-if="props.errors">
        <p v-for="error in props.errors" v-html="error" />
    </div>
</div>
</template>