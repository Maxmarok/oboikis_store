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
        title: 'Реквизиты',
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
            <span class="about_company_text1 blue_color">Реквизиты магазина <span> «Обойкис»</span></span>
 
            <div class="about_company_text3 flex-column justify-content-between">

                <p>Индивидуальный предприниматель <span class="pink_color">Бачурина Марина Анатольевна</span></p>
                
                <p>Адрес: <span class="pink_color">614039, г. Пермь, ул. Газеты Звезда, д.67, кв.4.</span></p>
                <p>Телефон: <span class="pink_color">+7 (909) 110-50-82, +7 (912) 780-39-35</span></p>
                <p>E-mail: <span class="pink_color">oboikis@yandex.ru</span></p>
                <p>ИНН: <span class="pink_color">590401127358</span></p>
                <p>Расчетный счет: <span class="pink_color">40802810729730003103</span></p>
                <p>Банк: <span class="pink_color">ФИЛИАЛ "НИЖЕГОРОДСКИЙ" АО "АЛЬФА-БАНК"</span></p>
                <p>Корреспондентский счет: <span class="pink_color">30101810200000000824</span></p>
                <p>БИК: <span class="pink_color">042202824</span></p>
            </div>
        </div>
    </div>
</div>
<Footer/>
</template>