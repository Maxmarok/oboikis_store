<script setup>
import { useInfoStore } from '@js/stores/infoStore'
const info = useInfoStore()

const catalog = [
    {
        title: 'Обои',
        section: 'wallpaper',
    },
    {
        title: 'Фотообои',
        section: 'photo',
    },
    {
        title: 'Фрески',
        section: 'fresk',
    },
    {
        title: 'Лепной декор',
        section: 'decor',
    },
    {
        title: 'Клей',
        section: 'glue',
    },
]
</script>
<template>
<footer class="w-auto d-flex bg_blue mt-auto">
    <div class="foot m-auto d-flex flex-row justify-content-between align-items-center position-relative">
        <div class="footer_block1 d-flex justify-content-between flex-column">
            <router-link :to="{name: 'home'}">
                <img src="/svg/horizontal.svg">
            </router-link>
            <span class="white_color text-center align-items-end">© 2021 – 2024 «Обойкис»</span>
        </div>
        <div class="footer_divider_block">
            <div class="footer_divider1 footer_divider_white"></div>
        </div>
        <div class="footer_block d-flex flex-row justify-content-between">
            <div class="footer_element d-flex flex-column">
                <span class="footer_text1 white_color mb-3">Компания</span>
                <div class="d-flex flex-column justify-content-between footer_text2 white_color">
                    <router-link :to="{name: 'about'}" active-class="yellow_color">О компании</router-link>
                    <router-link :to="{name: 'contacts'}" active-class="yellow_color">Контакты</router-link>
                    <router-link :to="{name: 'docs'}" active-class="yellow_color">Реквизиты</router-link>
                </div>
            </div>
            <div class="footer_element d-flex flex-column">
                <span class="footer_text1 white_color mb-3">Каталог</span>
                <div class="d-flex flex-column justify-content-between footer_text2 white_color ">
                    <router-link 
                        v-for="item in catalog" 
                        :to="{
                            name: 'catalog', 
                            params: {
                                section: item.section,
                            }
                        }"
                        v-html="item.title"
                        active-class="yellow_color"
                    />
                </div>
            </div>
            <div class="footer_element d-flex flex-column">
                <span class="footer_text1 white_color mb-3">Доставка</span>
                <div class="d-flex flex-column justify-content-between footer_text2 white_color">
                    <router-link :to="{name: 'delivery'}" active-class="yellow_color">Условия доставки</router-link>
                    <router-link :to="{name: 'payment'}" active-class="yellow_color">Способы оплаты</router-link>
                </div>
            </div>
        </div>
        <div class="footer_block2 d-flex justify-content-between flex-column">
            <div class="contact d-flex flex-column">
                <span class="footer_text1 white_color text-end mb-3">Свяжитесь с нами</span>
                <div class="contact_icons">
                    <a :href="info.vk" v-if="info.vk" target="_blank">
                        <img src="/svg/vk_icon2.svg">
                    </a>

                    <a :href="info.telegram" v-if="info.telegram" target="_blank">
                        <img src="/svg/tg_icon2.svg">
                    </a>

                    <a :href="info.whatsapp" v-if="info.whatsapp" target="_blank">
                        <img src="/svg/wa_icon2.svg">
                    </a>

                    <a :href="info.viber" v-if="info.viber" target="_blank">
                        <img src="/svg/vb_icon2.svg">
                    </a>
                </div>
            </div>
            <div class="footer_divider_block">
                <div class="footer_divider2 footer_divider_white"></div>
            </div>
            <div class="d-flex flex-column align-items-end white_color flex-nowrap footer_block2_elem1">

                <router-link :to="{name: 'policy'}">
                    <span class="footer_block2_text1 f_b2_text_border_white">Политика конфиденциальности</span>
                </router-link>

                <router-link :to="{name: 'offer'}">
                    <span class="footer_block2_text2 f_b2_text_border_white">Публичная оферта</span>
                </router-link>
            </div>
            <div class="footer_divider_block">
                <div class="footer_divider3 footer_divider_white"></div>
            </div>
            <div class="footer_block2_elem2 d-flex justify-content-center align-items-center">
                <span class="white_color">© 2021 – 2024 «Обойкис»</span>
            </div>
        </div>
    </div>
</footer>
</template>