<script setup>
import {onMounted, ref} from 'vue'
import Header from '@js/components/Header.vue'
import Menu from '@js/components/Menu.vue'
import Footer from '@js/components/Footer.vue'
import Breadcrumbs from '@js/components/Breadcrumbs.vue'

const breadcrumbs = [
    {
        title: 'Главная',
        link: '/',
    },
    {
        title: 'Условия доставки',
        link: null,
    },
]

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
        
        <div class="about_company_text d-flex flex-column mb-5">
            <span class="about_company_text1 blue_color">Условия <span class="pink_color">доставки</span> магазина «Обойкис»</span>
            <div class="about_company_text3 flex-column justify-content-between">
                <p>Отправка <span class="pink_color">в любой город</span> или округ</p>
                <p>Доставка по городу — от <span class="pink_color">500 рублей</span></p>
                <p>Возможно оформление через <span class="pink_color">Яндекс доставку</span></p>
            </div>
        </div>
    </div>
</div>
<Footer/>
</template>