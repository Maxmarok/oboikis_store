<script setup>
import {ref} from 'vue'
import helper from '@js/components/helper.js'
import { useCartStore } from '@js/stores/cartStore'
import { useInfoStore } from '@js/stores/infoStore'
const store = useCartStore()
const info = useInfoStore()

const menuOpen = ref(false)

const toggleMenu = () => menuOpen.value = !menuOpen.value
</script>
<template>
    <nav class="w-auto bg_blue mobile_header_border">
        <div class="menu d-flex m-auto justify-content-between flex-row bg_blue vw-100">
            <div class="nav_element d-flex d-lg-none flex-column  align-self-center position-relative" 
                :class="{active: menuOpen, 'justify-content-center': menuOpen, 'justify-content-around': !menuOpen}" @click="toggleMenu"
            >
                <div class="nav_element_line1" :class="{'nav_element_rotate1': menuOpen}"></div>
                <div class="nav_element_line2" :class="{'nav_element_rotate2': menuOpen}"></div>
            </div>
            <div class="menu_contacts d-flex flex-row align-items-center">
                <div class="contacts d-flex flex-column align-items-center me-4">
                    <div class="number d-flex pb-1">
                        <a :href="`tel:+${info.phone}`" class="text-decoration-none white_color" v-html="helper.getPhone(info.phone)" />
                    </div>
                    <div class="d-flex align-items-center">
                        <a :href="`mailto:${info.email}`" class="text-decoration-none white_color" v-html="info.email" />
                    </div>
                </div>
                <!-- <div class="city d-flex align-items-center justify-content-between"><img src="/svg/house.svg" class="me-1">г. Пермь</div> -->
            </div> 
            <div class="d-flex align-items-center menu_logo">
                <router-link :to="{name: 'home'}">
                    <img src="/svg/horizontal.svg">
                </router-link>
            </div>
            <div class="header_block3 d-flex justify-content-end align-items-center">
                <!-- <div class="search">
                    <form class="d-flex justify-content-center align-items-center" action="" method="GET">
                        <input name="s" placeholder="Поиск..." type="search" class="white_color">
                        <button type="submit"><img src="/svg/glass.svg"></button>
                    </form>
                </div> -->
                <router-link :to="{name: 'cart'}">
                    <div class="d-flex flex-row align-items-center cart_header" :class="{active: store.cart.length > 0}">
                        <div class="counter d-flex align-items-center justify-content-center" v-html="store.cart.length" />
                        <div class="menu_cart_block">Корзина<img src="/svg/cart.svg" class="ms-2"></div>
                    </div>
                </router-link>
            </div>
            <div class="menu2 vw-100 white_color justify-content-between position-absolute flex-column" :class="{'menu2_open': menuOpen}">
                <div class="menu2_block1 d-flex justify-content-around">
                    <div class="menu2_block1_element d-flex flex-column">
                        <router-link :to="{name: 'home'}" class="menu2_block1_element_text1">Главная</router-link>
                        <router-link :to="{name: 'cart'}"  class="menu2_block1_element_text2">Корзина</router-link>
                        <!-- <div class="menu2_block1_divider w-100 position-relative">
                            <div class="position-absolute"></div>
                        </div> -->
                        <div class="menu2_block1_element_text1 mt-4">Компания</div>
                        <router-link :to="{name: 'about'}"  class="menu2_block1_element_text2">О компании</router-link>
                        <router-link :to="{name: 'contacts'}"  class="menu2_block1_element_text2">Контакты</router-link>
                        <router-link :to="{name: 'docs'}"  class="menu2_block1_element_text2">Реквизиты</router-link>
                    </div>
                    <div class="menu2_block1_element d-flex flex-column">
                        <div class="menu2_block1_element_text1">Каталог</div>

                        <router-link 
                            v-for="item in info.catalog" 
                            :to="{
                                name: 'catalog',
                                params: {
                                    section: item.url,
                                }
                            }"
                            class="menu2_block1_element_text2" 
                            v-html="item.name"
                            @click="toggleMenu"
                        />
                    </div>
                </div>
                <div class="menu2_block2 d-flex flex-column align-items-center justify-content-between">
                    <div class="menu2_block2_divider w-100 position-relative">
                        <div class="position-absolute"></div>
                    </div>
                    <!-- <div class="search d-block">
                        <form class="d-flex justify-content-center align-items-center" action="" method="GET">
                            <input name="s" placeholder="Поиск..." type="search" class="white_color">
                            <button type="submit"><img src="/svg/glass.svg"></button>
                        </form>
                    </div> -->
                    <div class="contacts d-flex flex-column align-items-center me-4">
                        <div class="number d-flex pb-1">
                            <a :href="`tel:+${info.phone}`" class="text-decoration-none white_color" v-html="helper.getPhone(info.phone)" />
                        </div>
                        <div class="d-flex align-items-center">
                            <a :href="`mailto:${info.email}`" class="text-decoration-none white_color" v-html="info.email" />
                        </div>
                    </div>
                    <div class="contact_icons">
                        <a :href="info.vk" target="_blank">
                            <img class="contacts_icon" src="/svg/vk_icon2.svg">
                        </a>
                        <a :href="info.telegram" target="_blank">
                            <img class="contacts_icon" src="/svg/tg_icon2.svg">
                        </a>
                        <a :href="info.whatsapp" target="_blank">
                            <img class="contacts_icon" src="/svg/wa_icon2.svg">
                        </a>
                        <a :href="info.viber" target="_blank">
                            <img class="contacts_icon" src="/svg/vb_icon2.svg">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>