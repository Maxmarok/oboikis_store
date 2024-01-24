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
        title: 'Способы оплаты',
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
            <span class="about_company_text1 blue_color">Способы <span>оплаты</span></span>
            <div class="about_company_text3 flex-column justify-content-between">
                <p>Возможна оплата через <span class="pink_color">QR-код</span> или <span class="pink_color">по реквизитам</span></p>
                <p>Также в салонах магазина можно оплатить <span class="pink_color">наличными</span> или <span class="pink_color">банковскими картами</span></p>
            </div>
        </div>
    </div>
</div>
<Footer/>
</template>