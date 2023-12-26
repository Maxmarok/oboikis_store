<script setup>
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
const props = defineProps(['items', 'breakpoints'])
</script>
<template>
<carousel class="owl-carousel owl-theme slider1 screen3_cards" ref="carousel" :wrapAround="true" :breakpoints="props.breakpoints">
    <slide v-for="slide in props.items" :key="slide.id">
        <div class="screen3_block d-flex flex-column p-auto position-relative s3_b_pink" :class="{'s3_b_pink': slide.promo === 'sale'}">
            <div v-if="slide.discount" class="discount d-flex justify-content-center align-items-center bg_pink">
                <span v-html="`-${slide.discount}%`" />
            </div>

            <div class="s3_b_img">
                <img :src="slide.src">
            </div>

            <div class="s3_b1_text d-flex flex-row justify-content-around align-items-center w-100 pink_color bg_pink2">
                <div class="s3_b_text0 d-flex align-items-center justify-content-center">
                    <span v-if="slide.stock > 0" v-html="`${slide.stock} рулонов`" />
                </div>

                <div class="d-flex w-50">
                    <span class="s3_b_text1" v-html="slide.description" />
                </div>
            </div>

            <div class="s3_b_text2 d-flex w-100 justify-content-center align-items-center px-4 pink_color">
                <span class="text-center w-100" v-html="slide.title" />
            </div>

            <div class="s3_b_footer_pink d-flex flex-row justify-content-between px-3 align-items-center">
                <div>
                    <div class="d-flex flex-column">
                        <span class="s3_b_f_text1" v-html="`${slide.old_price} ₽`" />
                        <span class="s3_b_f_text2" v-html="`${slide.price} ₽`" />
                    </div>
                </div>
                <button class="d-flex pink_color flex-row align-items-center justify-content-evenly">
                    <span class="s3_b_footer_btn_text1">Купить</span>
                    <span class="s3_b_footer_btn_text2">В корзину</span>
                    <img src="svg/pinkcart.svg">
                </button>
            </div>
        </div>
    </slide>

    <template #addons>
        <navigation />
        <pagination />
    </template>
</carousel>
</template>