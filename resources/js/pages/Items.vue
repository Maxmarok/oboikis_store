<script setup>
import {onMounted, onUnmounted, ref, watch} from 'vue'
import Header from '@js/components/Header.vue'
import Menu from '@js/components/Menu.vue'
import Footer from '@js/components/Footer.vue'
import Breadcrumbs from '@js/components/Breadcrumbs.vue'
import Loader from '@js/components/Loader.vue'
import { Bootstrap5Pagination } from 'laravel-vue-pagination'

import { useRoute } from 'vue-router'

import Item from '@js/components/Item.vue'
import Multiselect from "@vueform/multiselect"

const route = useRoute()
const breadcrumbs = ref()
const title = ref()
const items = ref(null)
const sections = ref()
const search = ref()

const filters = ref({
    country: null,
    producer: null,
    size: null,
    material: null,
})

const filterSales = ref(false)
const menuOpen = ref(false)

const getItems = (page = 1) => {

    items.value = null

    let obj = {
        catalog: route.params.section,
        filters: filters.value,
        sales: filterSales.value,
        page: page,
    }
    if(search.value) obj.search = search.value

    axios.post('/api/v1/items', obj)
        .then((res) => {
            res = res.data
            breadcrumbs.value = res.breadcrumbs
            title.value = res.title
            items.value = res.data
            sections.value = res.sections
        })
}

onMounted(() => getItems())

watch(() => route.params.section,
    newSection => {
        items.value = null
        title.value = null
        breadcrumbs.value = null
        sections.value = null
        getItems()
    }
)

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
        <div class="bread">
            <Breadcrumbs :items="breadcrumbs"/>
        </div>
        <div class="d-flex flex-row justify-content-between w-100 mb-3 filter_screen_text">
            <div class="contacts_text2 blue_color catalog_text2 m-lg-0" v-html="title" />
        </div>
        <Bootstrap5Pagination
            :data="items"
            @pagination-change-page="getItems"
            :show-disabled="true"
            :limit="5"
            v-if="items && items.data.length > 0"
            class="d-none d-lg-block"
        />

        <Bootstrap5Pagination
            :data="items"
            @pagination-change-page="getItems"
            :show-disabled="true"
            :limit="1"
            :size="'small'"
            v-if="items && items.data.length > 0"
            class="d-block d-lg-none"
        />

        <div class="catalog_filter_bottom d-flex flex-column-reverse flex-lg-row justify-content-center justify-content-lg-between align-items-center align-items-lg-start m-auto m-lg-0 w-100">
           
            <div class="d-flex flex-column w-100">
                <div class="catalog_filter_cards" v-if="items && items.data.length > 0">
                    <Item v-for="item in items.data" :item="item" />
                </div>
                <div class="about_company_text3 mt-0 mt-lg-4 me-lg-5 mx-2 mx-lg-0" v-if="items && items.data.length === 0">
                    <p>Товары с указанным фильтром <span class="pink_color">не найдены</span></p>
                </div>
                <Loader v-if="!items" />
            </div>
            <div class="show_filter d-flex d-lg-none">
                <div class="show_filter_header align-self-center" @click="menuOpen = !menuOpen">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.5 5.83333C2.5 5.3731 2.8731 5 3.33333 5H16.6667C17.1269 5 17.5 5.3731 17.5 5.83333C17.5 6.29357 17.1269 6.66667 16.6667 6.66667H3.33333C2.8731 6.66667 2.5 6.29357 2.5 5.83333ZM5 10C5 9.53975 5.3731 9.16667 5.83333 9.16667H14.1667C14.6269 9.16667 15 9.53975 15 10C15 10.4602 14.6269 10.8333 14.1667 10.8333H5.83333C5.3731 10.8333 5 10.4602 5 10ZM7.5 14.1667C7.5 13.7064 7.8731 13.3333 8.33333 13.3333H11.6667C12.1269 13.3333 12.5 13.7064 12.5 14.1667C12.5 14.6269 12.1269 15 11.6667 15H8.33333C7.8731 15 7.5 14.6269 7.5 14.1667Z" fill="white"/>
                    </svg>
                    <span id="show_filter_header_text1" v-if="!menuOpen">Показать фильтр</span>
                    <span id="show_filter_header_text2" v-else>Скрыть фильтр</span>
                </div>
            </div>
            <div class="filter d-lg-block" :class="{'d-none': !menuOpen}" v-if="sections">
                <div class="filter_container s3_b_blue">
                    <div class="d-flex align-items-center filter_header justify-content-center bg_blue white_color">Фильтр</div>
                    <div class="filter_body">
                        <div class="filter_body_center d-flex justify-content-between flex-column">
                            <div class="filter_body_center_elem d-flex flex-column blue_color">
                                <span class="mb-2">Поиск</span>
                                <input type="text" class="search bg_white mt-1 blue_color s3_b_blue" placeholder="Введите слова для поиска" v-model="search" />
                            </div>
                        </div>

                        <!-- <div class="filter_body_header d-flex flex-column justify-content-evenly blue_color">
                            <span class="mb-3">Цена</span>
                            <div class="d-flex justify-content-between flex-column">
                                <vue-slider v-model="value" :enable-cross="false"/>

                                <div class="rs_values d-flex justify-content-between position-relative mt-3">
                                    <div class="rs_value1_triangle position-absolute"></div>
                                    <div class="rs_value2_triangle position-absolute"></div>
                                    <input class="rs_value1 text-center blue_color" type="number" value="0" readonly>
                                    <input class="rs_value2 text-center blue_color" type="number" value="0" readonly>
                                </div>
                            </div>
                        </div> -->
                        <div class="filter_body_center d-flex justify-content-between flex-column" v-if="sections.length > 0">
                            <div class="filter_body_center_elem d-flex flex-column blue_color" v-for="section in sections">
                                <span class="mb-2" v-html="section['title']" />

                                <Multiselect
                                    v-model="filters[section['key']]"
                                    :options="section['values']"
                                    :placeholder="'Выберите из списка'"
                                    :canClear="false"
                                />
                            </div>
                        </div>
                        <div class="filter_body_footer d-flex flex-column justify-content-between pt-4 pb-4" v-if="false">
                            <span class="filter_body_footer_text1 blue_color mb-3">Категория товаров</span>
                            <!-- <div class="d-flex flex-row">
                                <input class="orange_check" type="checkbox" id="orange_check">
                                <label for="orange_check"></label>
                                <span class="filter_body_footer_text2 orange_color">Распродажа</span>
                            </div> -->
                            <div class="d-flex flex-row">
                                <input class="pink_check" type="checkbox" id="pink_check" v-model="filterSales">
                                <label for="pink_check"></label>
                                <label for="pink_check" class="filter_body_footer_text2 pink_color">Товары по акции</label>
                            </div>
                        </div>
                    </div>
                    <div class="filter_footer d-flex align-items-center justify-content-center">
                        <button class="bg_blue white_color" @click="getItems()">Применить</button>
                    </div>
                </div>
            </div>
        </div>
        <Bootstrap5Pagination
            :data="items"
            @pagination-change-page="getItems"
            :show-disabled="true"
            :limit="5"
            v-if="items && items.data.length > 0"
            class="d-none d-lg-block"
        />

        <Bootstrap5Pagination
            :data="items"
            @pagination-change-page="getItems"
            :show-disabled="true"
            :limit="1"
            :size="'small'"
            v-if="items && items.data.length > 0"
            class="d-block d-lg-none"
        />
    </div>
</div>

<Footer/>
</template>