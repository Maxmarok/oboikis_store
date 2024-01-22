<script setup>
import {onMounted, ref} from 'vue'
import Header from '@js/components/Header.vue'
import Menu from '@js/components/Menu.vue'
import Footer from '@js/components/Footer.vue'
import Breadcrumbs from '@js/components/Breadcrumbs.vue'

import Item from '@js/components/Item.vue'

import VueSlider from 'vue-slider-component'
import 'vue-slider-component/theme/antd.css'

import Multiselect from "@vueform/multiselect"

const breadcrumbs = ref()
const title = ref()
const items = ref()

let value = [0, 100000]
const selected = ref(null)
let options = [
    'Обои',
    'Фотообои',
    'Фреска',
    'Лепной декор',
]

const getItems = async () => {
    return axios.post('/api/v1/items', {catalog: 'wallpapper'})
        .then((res) => {
            return res.data
        })
}

onMounted(() => {
    getItems().then(res => {
        items.value = res.data
        breadcrumbs.value = res.breadcrumbs
        title.value = res.title
    })
})


</script>
<template>
<Header/>
<Menu />
<div class="catalog_filter_block w-auto">
    <div class="bc_block m-auto w-100">
        <div class="breadcrumbs mb-5 ms-auto me-auto mt-5">
            <Breadcrumbs :items="breadcrumbs"/>
        </div>
    </div>
    <div class="catalog_filter_screen me-auto ms-auto d-flex align-items-start justify-content-between flex-column">
        <div class="mb-5 bread">
            <Breadcrumbs :items="breadcrumbs"/>
        </div>
        <div class="d-flex flex-row justify-content-between w-100 mb-3 filter_screen_text">
            <div class="contacts_text2 blue_color catalog_text2 m-0" v-html="title" />

        </div>
        <div class="catalog_filter_bottom d-flex flex-row justify-content-between w-100">
            <div class="d-flex flex-column w-100">
                <div class="catalog_filter_cards">
                    <Item v-for="item in items" :item="item" />
                </div>
                <div class="filter_dots d-flex align-self-center justify-content-between">
                    <img src="/svg/blue_dot.svg">
                    <img src="/svg/yellow_dot.svg">
                    <img src="/svg/pink_dot.svg">
                </div>
            </div>
            <div class="show_filter display-none">
                <div class="show_filter_header align-self-center">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.5 5.83333C2.5 5.3731 2.8731 5 3.33333 5H16.6667C17.1269 5 17.5 5.3731 17.5 5.83333C17.5 6.29357 17.1269 6.66667 16.6667 6.66667H3.33333C2.8731 6.66667 2.5 6.29357 2.5 5.83333ZM5 10C5 9.53975 5.3731 9.16667 5.83333 9.16667H14.1667C14.6269 9.16667 15 9.53975 15 10C15 10.4602 14.6269 10.8333 14.1667 10.8333H5.83333C5.3731 10.8333 5 10.4602 5 10ZM7.5 14.1667C7.5 13.7064 7.8731 13.3333 8.33333 13.3333H11.6667C12.1269 13.3333 12.5 13.7064 12.5 14.1667C12.5 14.6269 12.1269 15 11.6667 15H8.33333C7.8731 15 7.5 14.6269 7.5 14.1667Z" fill="white"/>
                    </svg>
                    <span id="show_filter_header_text1">Показать фильтр</span>
                    <span class="d-none" id="show_filter_header_text2">Скрыть фильтр</span>
                </div>
                <div class="filter s3_b_blue d-none" id="sf_filter">
                    <div class="d-none align-items-center filter_header justify-content-center bg_blue white_color d-lg-flex">Фильтр</div>
                    <div class="filter_body ps-4 pe-4">
                        <div class="filter_body_header d-flex flex-column justify-content-evenly blue_color">
                            <span class="mb-3">Цена</span>
                            <div class="d-flex justify-content-between flex-column">

                                <!-- <div class="range_slider m-0"></div>
                                <div class="rs_values d-flex justify-content-between position-relative mt-3">
                                    <div class="rs_value1_triangle position-absolute"></div>
                                    <div class="rs_value2_triangle position-absolute"></div>
                                    <input class="rs_value1 text-center blue_color" type="number" value="0" readonly>
                                    <input class="rs_value2 text-center blue_color" type="number" value="0" readonly>
                                </div> -->
                            </div>
                        </div>
                        <div class="filter_body_center d-flex justify-content-between flex-column">
                            <div class="filter_body_center_elem d-flex flex-column blue_color">
                                <span class="mb-2">Тип товара</span>
                                <div class="filter_body_center_btn position-relative d-flex">
                                    <select>
                                        <option>Выбрать тип товара</option>
                                        <option>Обои</option>
                                        <option>Фотообои</option>
                                        <option>Фреска</option>
                                        <option>Лепной декор</option>
                                    </select>
                                </div>

                                <multiselect
                                    v-model="selected"
                                    :options="options"
                                />
                            </div>
                            <div class="filter_body_center_elem d-flex flex-column blue_color">
                                <span class="mb-2">Бренд</span>
                                <div class="filter_body_center_btn position-relative d-flex">
                                    <select>
                                        <option>Выбрать бренд</option>
                                        <option>Выбрать бренд</option>
                                        <option>Выбрать бренд</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="filter_body_center_elem d-flex flex-column blue_color">
                                <span class="mb-2">Размер</span>
                                <div class="filter_body_center_btn position-relative d-flex">
                                    <select>
                                        <option>10.05 x 1.06 м</option>
                                        <option>10.05 x 1.06 м</option>
                                        <option>10.05 x 1.06 м</option>
                                    </select>
                                </div>
                            </div>
                            <div class="filter_body_center_elem d-flex flex-column blue_color">
                                <span class="mb-2">Материал</span>
                                <div class="filter_body_center_btn position-relative d-flex">
                                    <select>
                                        <option>Выбрать материал</option>
                                        <option>Выбрать материал</option>
                                        <option>Выбрать материал</option>
                                    </select>
                                </div>
                            </div>
                            <div class="filter_body_center_elem d-flex flex-column blue_color">
                                <span class="mb-2">Страна производителя</span>
                                <div class="filter_body_center_btn position-relative d-flex">
                                    <select>
                                        <option>Выбрать страну произв.</option>
                                        <option>Выбрать страну произв.</option>
                                        <option>Выбрать страну произв.</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="filter_body_footer d-flex flex-column justify-content-between pt-4 pb-4">
                            <span class="filter_body_footer_text1 blue_color">Категория товаров</span>
                            <div class="d-flex flex-row">
                                <input class="orange_check" type="checkbox" id="orange_check">
                                <label for="orange_check"></label>
                                <span class="filter_body_footer_text2 orange_color">Распродажа</span>
                            </div>
                            <div class="d-flex flex-row">
                                <input class="pink_check" type="checkbox" id="pink_check">
                                <label for="pink_check"></label>
                                <span class="filter_body_footer_text2 pink_color">Товары по акции</span>
                            </div>
                        </div>
                    </div>
                    <div class="filter_footer d-flex align-items-center justify-content-center">
                        <button class="bg_blue white_color">Применить</button>
                    </div>
                </div>
            </div>
            <div class="filter s3_b_blue">
                <div class="d-flex align-items-center filter_header justify-content-center bg_blue white_color">Фильтр</div>
                <div class="filter_body ps-4 pe-4">
                    <div class="filter_body_header d-flex flex-column justify-content-evenly blue_color">
                        <span class="mb-3">Цена</span>
                        <div class="d-flex justify-content-between flex-column">
                            <!-- <vue-slider v-model="value" :enable-cross="false"/> -->

                            <div class="rs_values d-flex justify-content-between position-relative mt-3">
                                <div class="rs_value1_triangle position-absolute"></div>
                                <div class="rs_value2_triangle position-absolute"></div>
                                <input class="rs_value1 text-center blue_color" type="number" value="0" readonly>
                                <input class="rs_value2 text-center blue_color" type="number" value="0" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="filter_body_center d-flex justify-content-between flex-column">
                        <div class="filter_body_center_elem d-flex flex-column blue_color">
                            <span class="mb-2">Тип товара</span>

                            <Multiselect
                                v-model="selected"
                                :options="options"
                                :placeholder="'Выбрать тип товара'"
                                :canClear="false"
                            />
                        </div>
                        <div class="filter_body_center_elem d-flex flex-column blue_color">
                            <span class="mb-2">Бренд</span>
                            <div class="filter_body_center_btn position-relative d-flex">
                                <select>
                                    <option>Выбрать бренд</option>
                                    <option>Выбрать бренд</option>
                                    <option>Выбрать бренд</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="filter_body_center_elem d-flex flex-column blue_color">
                            <span class="mb-2">Размер</span>
                            <div class="filter_body_center_btn position-relative d-flex">
                                <select>
                                    <option>10.05 x 1.06 м</option>
                                    <option>10.05 x 1.06 м</option>
                                    <option>10.05 x 1.06 м</option>
                                </select>
                            </div>
                        </div>
                        <div class="filter_body_center_elem d-flex flex-column blue_color">
                            <span class="mb-2">Материал</span>
                            <div class="filter_body_center_btn position-relative d-flex">
                                <select>
                                    <option>Выбрать материал</option>
                                    <option>Выбрать материал</option>
                                    <option>Выбрать материал</option>
                                </select>
                            </div>
                        </div>
                        <div class="filter_body_center_elem d-flex flex-column blue_color">
                            <span class="mb-2">Страна производителя</span>
                            <div class="filter_body_center_btn position-relative d-flex">
                                <select>
                                    <option>Выбрать страну произв.</option>
                                    <option>Выбрать страну произв.</option>
                                    <option>Выбрать страну произв.</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="filter_body_footer d-flex flex-column justify-content-between pt-4 pb-4">
                        <span class="filter_body_footer_text1 blue_color">Категория товаров</span>
                        <div class="d-flex flex-row">
                            <input class="orange_check" type="checkbox" id="orange_check">
                            <label for="orange_check"></label>
                            <span class="filter_body_footer_text2 orange_color">Распродажа</span>
                        </div>
                        <div class="d-flex flex-row">
                            <input class="pink_check" type="checkbox" id="pink_check">
                            <label for="pink_check"></label>
                            <span class="filter_body_footer_text2 pink_color">Товары по акции</span>
                        </div>
                    </div>
                </div>
                <div class="filter_footer d-flex align-items-center justify-content-center">
                    <button class="bg_blue white_color">Применить</button>
                </div>
            </div>
        </div>
    </div>
</div>

<Footer/>
</template>