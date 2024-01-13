<script setup>
import helper from '@js/components/helper.js'
const props = defineProps(['item'])



const getStock = () => {
    return helper.getNoun(props.item.stock, 'товар', 'товара', 'товаров')
}

let discount = props.item.discount_percent > 0
</script>
<template>
<div class="screen3_block d-flex flex-column p-auto position-relative" 
    :class="{
        's3_b_pink': discount,
        's3_b_blue': !discount
    }">
    <div v-if="props.item.discount_percent > 0" class="discount d-flex justify-content-center align-items-center"
        :class="{
            'bg_pink': discount,
        }">
        <span v-html="`-${props.item.discount_percent}%`" />
    </div>

    <div class="s3_b_img">
        <img :src="props.item.image">
    </div>

    <div class="s3_b1_text d-flex flex-row justify-content-around align-items-center w-100"
        :class="{
            's3_b1_text bg_pink2': discount,
            's3_b_text': !discount
        }">
        <div class="s3_b_text0 d-flex align-items-center justify-content-center"
            :class="{
                'pink_color': discount,
                'blue_color': !discount,
                'gray_color': props.item.stock === 0
            }">
                <span v-if="props.item.stock > 0" v-html="getStock()" />
                <span v-else v-html="'На заказ'" />
        </div>

        <div class="d-flex w-50">
            <span class="s3_b_text1" v-html="props.item.description" />
        </div>
    </div>

    <div class="s3_b_text2 d-flex w-100 justify-content-center align-items-center px-4"
        :class="{
            'pink_color': discount,
            'blue_color': !discount
        }">
        <span class="text-center w-100" v-html="props.item.title" />
    </div>

    <div class="d-flex flex-row justify-content-between px-3 align-items-center"
        :class="{
            's3_b_footer_pink': discount,
            's3_b_footer_blue': !discount
        }">
        <div>
            <div class="d-flex flex-column">
                <span class="s3_b_f_text1" v-if="props.item.discount" v-html="`${props.item.price} ₽`" />
                <span class="s3_b_f_text2" v-html="`${props.item.discount_price} ₽`" />
            </div>
        </div>
        <button class="d-flex flex-row align-items-center justify-content-evenly"
            :class="{
                'pink_color': discount,
                'blue_color': !discount
            }">
            <span class="s3_b_footer_btn_text1">Купить</span>
            <span class="s3_b_footer_btn_text2">В корзину</span>
            <img :src="discount ? '/svg/pinkcart.svg' : '/svg/bluecart.svg'" />
        </button>
    </div>
</div>
</template>