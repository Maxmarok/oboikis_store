<script setup>
import {onMounted, ref, inject, nextTick} from 'vue'
import { useCartStore } from '@js/stores/cartStore'
import { useRoute } from 'vue-router'

import Header from '@js/components/Header.vue'
import Menu from '@js/components/Menu.vue'
import Footer from '@js/components/Footer.vue'
import Breadcrumbs from '@js/components/Breadcrumbs.vue'
import Loader from '@js/components/Loader.vue'

import PhotoSwipeLightbox from 'photoswipe/lightbox'
import 'photoswipe/style.css'

import helper from '@js/components/helper.js'

const route = useRoute()
const store = useCartStore()

const breadcrumbs = ref()

const lightbox = ref(null)
const item = ref()
const itemForCart = ref({
    count: 1,
})
const itemFromStore = ref()

onMounted(() => {


    getItem(route.params.id).then(res => {
        item.value = res.data
        breadcrumbs.value = res.breadcrumbs

        console.log(store.cart)

        itemFromStore.value = store.cart.find(x => x.id === item.value.id)

        itemForCart.value.id = item.value.id

        if(itemFromStore.value) itemForCart.value.count = itemFromStore.value.count

        nextTick(() => {
            lightbox.value = new PhotoSwipeLightbox({
                gallery: '#gallery',
                children: 'a',
                pswpModule: () => import('photoswipe'),
            })

            lightbox.value.init()
        })
    })
});

const getItem = async (id) => {
    return axios.post('/api/v1/item', {id: id})
        .then((res) => {
            return res.data
        })
}

const getStock = (stock) => {
    if(item.type === 'Обои') return helper.getNoun(stock, 'рулон', 'рулона', 'рулонов')
    return helper.getNoun(stock, 'товар', 'товара', 'товаров')
}

const addToCart = () => {
    store.addItem(itemForCart.value)
    itemFromStore.value = itemForCart.value
}

const removeFromCart = () => {
    store.removeItem(itemForCart.value.id)
    itemFromStore.value = null
    itemForCart.value.count = 1
}


const changeValue = (value) => {
    if(itemForCart.value.count > 1 && value === -1) {
        itemForCart.value.count--
    }

    if(itemForCart.value.count < 99 && value === 1) {
        itemForCart.value.count++
    }
}

const changeInput = (e) => {
    let value = e.target.value.replace(' ', '').replace(/[^\.0-9]/g, '')
    
    if(value == null || value == '' || !(value > 0 && value < 100)) {
        e.target.value = itemForCart.value.count = 1 
    } else {
        itemForCart.value.count = value
    }
}


</script>
<template>
<Header/>
<Menu />
<div class="wallpaper_block w-100">
    <div class="bc_block m-auto w-100">
        <div class="breadcrumbs mb-5 ms-auto me-auto mt-5">
            <Breadcrumbs :items="breadcrumbs"/>
        </div>
    </div>
    <div class="contacts_text2 blue_color catalog_text2" v-if="item">
        <span class="blue_color">{{ item.title }}</span>
    </div>

    <div class="wallpaper_screen ms-auto me-auto">
        <div class="cart_screen_text">
            <Breadcrumbs :items="breadcrumbs"/>
        </div>
        <div v-if="item" class="wallpaper_screen_elem1 d-flex flex-column justify-content-between">
            <span class="wallpaper_screen_elem1_text blue_color" v-html="item.title" />
            <div class="wallpaper_screen_elem1_body d-flex flex-column flex-lg-row justify-content-between">
                <div class="wallpaper_screen_elem1_body_block1 position-relative">
                    <img :class="{
                        's3_b_pink': item.has_discount,
                        's3_b_blue': !item.has_discount
                    }" :src="item.image">

                    <div v-if="item.has_discount" 
                        class="discount d-flex justify-content-center align-items-center bg_pink m_disc"
                    >
                        <span v-html="`–${item.discount_percent}%`" />
                    </div>

                    <div class="wallpaper_screen_elem1_footer" id="gallery">
                        <a v-for="image in item.gallery.split(',')" :href="image" data-pswp-width="1200" data-pswp-height="1000">
                            <img class="s3_b_orange" :src="image">
                        </a>
                    </div>
                </div>
                <div class="wallpaper_screen_elem1_body_block2">
                    <div class="wallpaper_screen_elem1_body_container">
                        <div class="wallpaper_screen_elem1_body_e1">
                        <div class="wallpaper_screen_elem1_body_e_header white_color">Описание</div>
                        <div class="wallpaper_screen_elem1_body_e1_text blue_color d-flex align-items-center justify-content-start pe-4 ps-4">
                            {{item.country}}, <span class="ms-1 me-1">{{ item.size }},</span> {{ item.material }}
                        </div>
                        </div>
                        <div class="wallpaper_screen_elem1_body_e2">
                            <div class="wallpaper_screen_elem1_body_e_header white_color">Характеристики</div>
                            <div class="wallpaper_screen_elem1_body_e2_text d-flex justify-content-center align-items-start flex-column blue_color pe-4 ps-4">
                                <div class="pb-3">Тип товара: <span v-html="item.type" /></div>
                                <div class="pb-3">Бренд: <span v-html="item.producer" /></div>
                                <div class="pb-3">Артикул: <span v-html="item.id" /></div>
                                <div>Производство: <span v-html="item.country" /></div>
                            </div>
                        </div>
                        <div class="wallpaper_screen_elem1_body_e3">
                            <div class="wallpaper_screen_elem1_body_e_header white_color">Наличие и заказ</div>
                            <ul class="wallpaper_screen_elem1_body_e3_text d-flex justify-content-between flex-column blue_color">
                                <li v-if="item.stock > 0">В наличии <span class="pink_color" v-html="getStock(item.stock)" /></li>
                                <li v-else class="gray_color">В данный момент товара <span class="pink_color">нет в наличии</span> на складе</li>
                                <li v-if="item.stock > 0">Заказ свыше, чем <span class="pink_color" v-html="getStock(item.stock)" /> – на заказ от 10 дней</li>
                                <li v-else>На заказ <span class="pink_color">от 10 дней</span></li>
                                <li><span class="text-decoration-line-through me-2 gray_color" v-if="item.has_discount">{{ helper.getPrice(item.price) }}</span><span :class="{'pink_color': item.has_discount}">{{helper.getPrice(item.has_discount ? item.discount_price : item.price)}} ₽</span>  за 1 рулон</li>
                            </ul>
                            <div class="wallpaper_screen_elem1_body_e_footer d-flex align-self-center m-auto justify-content-between align-items-center ps-3 pe-3"
                                :class="{'footer_pink': item.has_discount}">
                                <div class="d-flex flex-column" v-if="item.has_discount">
                                    <span class="st_f_screen_footer_text1">{{ helper.getPrice(item.price * itemForCart.count) }}</span>
                                    <span class="st_f_screen_footer_text2 pink_color">{{ helper.getPrice(item.discount_price * itemForCart.count)}} ₽</span>
                                </div>
                                <span class="st_f_screen_footer_text2 blue_color" v-else>{{ helper.getPrice(item.price * itemForCart.count)}} ₽</span>

                                <div class="d-flex">
                                    <button class="q-minus blue_color" :class="{'pink_color': item.has_discount}" @click="changeValue(-1)">-</button>
                                    <input class="quantity border-start-0 border-end-0 text-center blue_color" :class="{'pink_color': item.has_discount}" type="number" @input="(e) => changeInput(e)" :value="itemForCart.count">
                                    <button class="q-plus blue_color" :class="{'pink_color': item.has_discount}" @click="changeValue(1)">+</button>
                                </div>

                                <button class="footer_button blue_color" :class="{'pink_color': item.has_discount}" @click="addToCart" v-if="!itemFromStore">
                                    <span class="footer_button_text1">В Корзину</span>
                                    <span class="footer_button_text2">Добавить в корзину</span>
                                    <img class="ms-2" :src="item.has_discount ? '/svg/pinkcart.svg' : '/svg/bluecart.svg'">
                                </button>

                                <button class="footer_button blue_color" :class="{'pink_color': item.has_discount}" @click="removeFromCart" v-else>
                                    <span class="footer_button_text1">Убрать</span>
                                    <span class="footer_button_text2">Убрать из корзины</span>
                                    <img class="ms-2" :src="item.has_discount ? '/svg/pinkcart.svg' : '/svg/bluecart.svg'">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="wallpaper_screen_elem1_footer d-flex justify-content-between">
                <a v-for="image in item.gallery" :href="image" data-fancybox="gallery">
                    <img class="s3_b_blue" :src="image">
                </a>
            </div> -->
        </div>

        <Loader v-else />
    </div>
</div>
<Footer/>
</template>