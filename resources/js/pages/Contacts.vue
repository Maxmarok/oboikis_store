<script setup>
import helper from '@js/components/helper.js'
import { useInfoStore } from '@js/stores/infoStore'
const info = useInfoStore()

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
        title: 'Контакты',
        link: null,
    },
]
</script>
<template>
<Header/>
<Menu />
<div class="contacts_block w-auto align-items-center justify-content-center">
    <div class="bc_block m-auto w-100">
        <div class="breadcrumbs mb-5 ms-auto me-auto mt-5">
            <Breadcrumbs :items="breadcrumbs"/>
        </div>
    </div>
    <div class="contacts_screen me-auto ms-auto d-flex align-items-start justify-content-between flex-column">
        <div class="contacts_text d-flex flex-column">
            <div class="contacts_text1 d-flex align-items-start">
                <Breadcrumbs :items="breadcrumbs"/>
            </div>
        </div>
        <div class="contacts_text2 blue_color"><span>Контакты </span> магазина «Обойкис»</div>
        <div class="contacts_bottom_block d-flex w-100 position-relative">
            <img class="bg_contacts position-absolute" src="svg/bg_contacts.svg">
            <div class="contacts_info d-flex flex-column justify-content-evenly me-3">
                <div class="c_i_elem d-flex flex-column align-items-center position-relative">
                    <span class="c_i_elem_span1 blue_color text-center">Адрес:</span>
                    <span class="c_i_elem_span2 pink_color text-center">г. Пермь, ул. Героев Хасана, 56</span>
                    <span class="c_i_elem_span3 pink_color text-center border_bottom_pink c_i_elem_span1_width">ТЦ «Евразия», 2 этаж</span>
                    <div class="c_i_elem_border_bottom"></div>
                </div>
                <div class="c_i_elem  d-flex flex-column align-items-center position-relative">
                    <span class="c_i_elem_span1 blue_color text-center">Режим работы:</span>
                    <span class="c_i_elem_span2 pink_color text-center">ПН-СБ с 10:00 до 21:00</span>
                    <span class="c_i_elem_span3 pink_color text-center">ВС с 10:00 до 20:00</span>
                    <div class="c_i_elem_border_bottom"></div>
                </div>
                <div class="c_i_e_borderless d-flex flex-column align-items-center">
                    <div class="d-flex flex-column align-items-center mb-5 margin_block">
                        <span class="c_i_elem_span1 blue_color text-center">Контакты:</span>
                        <a :href="`tel:+${info.phone}`" class="text-decoration-none pink_color">
                            <span class="c_i_elem_span2 pink_color text-center border_bottom_pink c_i_elem_span2_width" v-html="helper.getPhone(info.phone)" />
                        </a>
                        <a :href="`mailto:${info.email}`" class="text-decoration-none pink_color">
                            <span class="c_i_elem_span3 pink_color text-center border_bottom_pink c_i_elem_span3_width" v-html="info.email" />
                        </a>
                    </div>
                    <div class="contacts_icons d-flex align-items-center justify-content-between">
                        <a :href="info.vk" target="_blank">
                            <img class="contacts_icon" src="svg/vk_icon.svg">
                        </a>
                        <a :href="info.telegram" target="_blank">
                            <img class="contacts_icon" src="svg/tg_icon.svg">
                        </a>
                        <a :href="info.whatsapp" target="_blank">
                            <img class="contacts_icon" src="svg/wa_icon.svg">
                        </a>
                    </div>
                </div>
            </div>
            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Afa9cda4220b075d88c43dd32dad1c4126c729c7d7f94ed1217de3e0e3afbf847&amp;source=constructor" frameborder="0"></iframe>
        </div>
    </div>
</div>
<Footer/>
</template>