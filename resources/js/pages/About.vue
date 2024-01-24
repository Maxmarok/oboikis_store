<script setup>
import {onMounted, ref} from 'vue'
import Header from '@js/components/Header.vue'
import Menu from '@js/components/Menu.vue'
import Footer from '@js/components/Footer.vue'
import Breadcrumbs from '@js/components/Breadcrumbs.vue'

import PhotoSwipeLightbox from 'photoswipe/lightbox'
import 'photoswipe/style.css'

const breadcrumbs = [
    {
        title: 'Главная',
        link: '/',
    },
    {
        title: 'О компании',
        link: null,
    },
]

const lightbox = ref(null)

onMounted(() => {
    lightbox.value = new PhotoSwipeLightbox({
        gallery: '#gallery',
        children: 'a',
        pswpModule: () => import('photoswipe'),
    })

    lightbox.value.init()
})
</script>
<template>
<Header/>
<Menu />
<div class="w-100 about_company_block position-relative">
    <div class="bc_block m-auto w-100">
        <div class="breadcrumbs mb-5 ms-auto me-auto mt-5">
            <Breadcrumbs :items="breadcrumbs"/>
        </div>
    </div>
    <div class="about_company_screen me-auto ms-auto position-relative">
        <div class="bread">
            <Breadcrumbs :items="breadcrumbs"/>
        </div>
        <!-- <img class="about_company_bg position-absolute" src="svg/about_company_bg.svg"> -->

        <div class="about_company_text d-flex flex-column mb-5">
            <span class="about_company_text1 blue_color">О компании <span> «Обойкис»</span></span>
            <div class="about_company_text3 flex-column justify-content-between">
                <p>Качественные европейские обои <span class="pink_color">премиум</span> класса</p>
                <p><span class="pink_color">Огромный</span> ассортимент, разнообразия цветовых и фактурных решений</p>
                <p><span class="pink_color">Итальянские, немецкие</span> производители в наличии и под заказ</p>
            </div>
        </div>

        <div class="about_company_footer d-flex flex-column justify-content-evenly align-items-center">
            <span class="blue_color">Фотогалерея магазина</span>
            <div class="about_company_body" id="gallery">
                <div class="about_company_body_elem">
                    <a href="img/photogallery_img1.jpeg" data-pswp-width="1200" data-pswp-height="1000">
                        <img src="img/photogallery_img1.jpeg">
                    </a>
                </div>
                <div class="about_company_body_elem">
                    <a href="img/photogallery_img1.jpeg" data-pswp-width="1200" data-pswp-height="1000">
                        <img src="img/photogallery_img1.jpeg">
                    </a>
                </div>

                <div class="about_company_body_elem">
                    <a href="img/photogallery_img1.jpeg" data-pswp-width="1200" data-pswp-height="1000">
                        <img src="img/photogallery_img1.jpeg">
                    </a>
                </div>

                <div class="about_company_body_elem">
                    <a href="img/photogallery_img1.jpeg" data-pswp-width="1200" data-pswp-height="1000">
                        <img src="img/photogallery_img1.jpeg">
                    </a>
                </div>

                <div class="about_company_body_elem">
                    <a href="img/photogallery_img1.jpeg" data-pswp-width="1200" data-pswp-height="1000">
                        <img src="img/photogallery_img1.jpeg">
                    </a>
                </div>

                <div class="about_company_body_elem">
                    <a href="img/photogallery_img1.jpeg" data-pswp-width="1200" data-pswp-height="1000">
                        <img src="img/photogallery_img1.jpeg">
                    </a>
                </div> 
            </div>
            <router-link class="btn white_color bg_pink" role="button" to="/catalog">Перейти к каталогу товаров</router-link>
        </div>
    </div>
</div>
<Footer/>
</template>