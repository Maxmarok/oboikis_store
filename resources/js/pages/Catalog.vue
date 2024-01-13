<script setup>
import {onMounted, ref} from 'vue'
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
        link: null,
    },
]

const menu = [
    {
        id: 1,
        title: 'Обои',
        icon: '/svg/wallpaper1.svg',
        items: [
            {
                title: 'Германия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Бельгия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Нидерланды',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Италия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Россия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Турция',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Франция',
                src: 'svg/flag_germany.svg',
                link: null,
            },

        ]
    },

    {
        id: 2,
        title: 'Фотообои',
        icon: '/svg/wallpaper2.svg',
        items: [
            {
                title: 'Германия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Бельгия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Нидерланды',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Италия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Россия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Турция',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Франция',
                src: 'svg/flag_germany.svg',
                link: null,
            },

        ]
    },

    {
        id: 3,
        title: 'Фрески',
        icon: '/svg/wallpaper3.svg',
        items: [
            {
                title: 'Германия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Бельгия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Нидерланды',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Италия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Россия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Турция',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Франция',
                src: 'svg/flag_germany.svg',
                link: null,
            },

        ]
    },

    {
        id: 4,
        title: 'Лепной декор',
        icon: '/svg/wallpaper4.svg',
        items: [
            {
                title: 'Германия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Бельгия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Нидерланды',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Италия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Россия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Турция',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Франция',
                src: 'svg/flag_germany.svg',
                link: null,
            },

        ]
    },

    {
        id: 5,
        title: 'Клей',
        icon: '/svg/bucket.svg',
        items: [
            {
                title: 'Германия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Бельгия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Нидерланды',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Италия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Россия',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Турция',
                src: 'svg/flag_germany.svg',
                link: null,
            },

            {
                title: 'Франция',
                src: 'svg/flag_germany.svg',
                link: null,
            },

        ]
    },
]

const menuVisible = ref(0)

const checkMenu = (id) => {
    return menuVisible.value == id
}

const setMenu = (id) => {
    if(menuVisible.value == id) {
        id = 0
    }

    menuVisible.value = id
}

</script>
<template>
<Header/>
<Menu />
<div class="contacts_block w-auto align-items-center justify-content-center">
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
    <div class="contacts_screen me-auto ms-auto d-flex align-items-start justify-content-between flex-column">
        <div class="contacts_text flex-column bread">
            <div class="contacts_text1 d-flex align-items-start">
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
        <div class="contacts_text2 blue_color catalog_text2"><span>Каталог</span> товаров</div>
        <div class="catalog_screen d-flex w-100 flex-row justify-content-between h-100">

            <div 
                class="catalog_block d-flex flex-column align-items-center catalog_block_margin" 
                v-for="list in menu"
            >
                <div 
                    class="d-flex flex-column catalog_block_header" 
                    :class="{'bg_blue': !checkMenu(list.id), 'bg_pink': checkMenu(list.id)}" 
                    @click="setMenu(list.id)"
                >
                    <div class="catalog_block_text d-flex flex-row">
                        <div class="d-flex catalog_block_element1">
                            <svg width="24" height="15" viewBox="0 0 24 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="dropdown_menu_arrow" :class="{'tr' : checkMenu(list.id)}">
                                <path d="M2 2L12 12L22 2" stroke="white" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="d-flex catalog_block_element2">
                            <img :src="list.icon">
                            <span class="white_color" v-html="list.title" />
                        </div>
                    </div>
                    <ul class="dropdown_menu_click" :class="{'visible': checkMenu(list.id)}">
                        <li class="d-flex align-items-center" v-for="item in list.items"><img class="me-3 ms-3" :src="item.src">{{ item.title }}</li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
</div>

<Footer/>
</template>