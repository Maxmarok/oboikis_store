<script setup>
import {onMounted, ref, inject} from 'vue'
import { useRoute } from 'vue-router'

import Header from '@js/components/Header.vue'
import Menu from '@js/components/Menu.vue'
import Footer from '@js/components/Footer.vue'

const breadcrumbs = [
    {
        title: 'Главная',
        link: '/',
    },
    {
        title: ' – Каталог',
        link: '/catalog',
    },
    {
        title: '– Обои',
        link: '/catalog/wallpaper',
    },
    {
        title: '– Обои Palitra Simple SP72068-17',
        link: null,
    }
]

onMounted(() => {

    const route = useRoute()

    console.log(route.params.id)

    // getStores().then(() => {
    //     filter.value.lk = route.params.id
    //     getData()
    // })
});

</script>
<template>
<Header/>
<Menu />
<div class="wallpaper_block w-100">
    <div class="bc_block m-auto w-100">
        <div class="breadcrumbs mb-5 ms-auto me-auto mt-5">
            <a v-for="item in breadcrumbs" 
                :class="{
                    'blue_color c_t1_span1': item.link,
                    'pink_color c_t1_span2': !item.link,
                }" 
                v-html="item.title"
                :href="item.link"
            />
        </div>
    </div>
    <div class="contacts_text2 blue_color catalog_text2 m-0">Обои <span class="blue_color">Palitra Simple SP72068-17</span></div>
    <div class="wallpaper_screen ms-auto me-auto">
        <div class="cart_screen_text">
            <a v-for="item in breadcrumbs" 
                :class="{
                    'blue_color c_t1_span1': item.link,
                    'pink_color c_t1_span2': !item.link,
                }" 
                v-html="item.title"
                :href="item.link"
            />
        </div>
        <div class="wallpaper_screen_elem1 d-flex flex-column justify-content-between">
            <span class="wallpaper_screen_elem1_text blue_color">Обои Milassa Ok6 001</span>
            <div class="wallpaper_screen_elem1_body d-flex flex-row justify-content-between">
                <div class="wallpaper_screen_elem1_body_block1 position-relative s3_b_blue">
                    <img class="w-100 h-100" src="img/image 2.png">
                    <!-- <div class="discount d-flex justify-content-center align-items-center bg_pink m_disc"><span>-10%</span></div> -->
                    <div class="wallpaper_screen_elem1_footer d-flex justify-content-between">
                        <a href="img/image 5.png" data-fancybox="gallery"><img class="s3_b_orange" src="img/image 5.png"></a>
                        <a href="img/image 5.png" data-fancybox="gallery"><img class="s3_b_orange" src="img/image 5.png"></a>
                        <a href="img/image 5.png" data-fancybox="gallery"><img class="s3_b_orange" src="img/image 5.png"></a>
                        <a href="img/image 5.png" data-fancybox="gallery"><img class="s3_b_orange" src="img/image 5.png"></a>
                        <a href="img/image 5.png" data-fancybox="gallery"><img class="s3_b_orange" src="img/image 5.png"></a>
                    </div>
                </div>
                <div class="wallpaper_screen_elem1_body_block2 d-flex flex-column justify-content-between">
                    <div class="wallpaper_screen_elem1_body_e1">
                        <div class="wallpaper_screen_elem1_body_e_header white_color">Описание</div>
                        <div class="wallpaper_screen_elem1_body_e1_text blue_color d-flex align-items-center justify-content-start pe-4 ps-4">Россия, <span class="ms-1 me-1">10.05 x 1.06 м</span>  Флизелин, Винил</div>
                    </div>
                    <div class="wallpaper_screen_elem1_body_e2">
                        <div class="wallpaper_screen_elem1_body_e_header white_color">Характеристики</div>
                        <div class="wallpaper_screen_elem1_body_e2_text d-flex justify-content-center align-items-start flex-column blue_color pe-4 ps-4">
                            <div class="pb-3">Тип товара: <span>Обои</span></div>
                            <div class="pb-3">Бренд: <span>Bernardo Bartalucci</span></div>
                            <div class="pb-3">Артикул: <span>002</span></div>
                            <div>Производство: <span>Россия</span></div>
                        </div>
                    </div>
                    <div class="wallpaper_screen_elem1_body_e3">
                        <div class="wallpaper_screen_elem1_body_e_header white_color">Наличие и заказ</div>
                        <ul class="wallpaper_screen_elem1_body_e3_text d-flex justify-content-between flex-column blue_color">
                            <li>В наличии <span class="pink_color">11 рулонов</span></li>
                            <li>Свыше <span class="pink_color">11 рулонов</span> на заказ от 10 дней</li>
                            <li>7 200 ₽ за 1 рулон</li>
                        </ul>
                        <div class="wallpaper_screen_elem1_body_e_footer d-flex align-self-center m-auto justify-content-between align-items-center ps-3 pe-3">
                            <span class="st_f_screen_footer_text2 blue_color">7 200 ₽</span>
                            <div class="d-flex">
                                <button class="q-minus blue_color">-</button>
                                <input class="quantity border-start-0 border-end-0 text-center blue_color" type="number" value="1">
                                <button class="q-plus blue_color">+</button>
                            </div>
                            <button class="footer_button blue_color fb_blue"><span class="footer_button_text1">В Корзину</span><span class="footer_button_text2">Добавить в корзину</span><img class="ms-2" src="svg/bluecart.svg"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wallpaper_screen_elem1_footer d-flex justify-content-between">
                <img class="s3_b_blue" src="img/image 2.png">
                <img class="s3_b_blue" src="img/image 2.png">
                <img class="s3_b_blue" src="img/image 2.png">
                <img class="s3_b_blue" src="img/image 2.png">
                <img class="s3_b_blue" src="img/image 2.png">
            </div>
        </div>
    </div>
</div>
<Footer/>
</template>