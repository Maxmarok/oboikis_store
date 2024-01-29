<script setup>
import { onMounted, ref } from 'vue'
import { useCartStore } from '@js/stores/cartStore'
import { useRouter } from 'vue-router'

import Header from '@js/components/Header.vue'
import Menu from '@js/components/Menu.vue'
import Footer from '@js/components/Footer.vue'
import Breadcrumbs from '@js/components/Breadcrumbs.vue'
import Loader from '@js/components/Loader.vue'
import helper from '@js/components/helper.js'

const router = useRouter()
const store = useCartStore()

const breadcrumbs = ref([])
const cart = ref()
const title = ref()

const getStock = (stock) => {
    return helper.getNoun(stock, 'товар', 'товара', 'товаров')
}

const getCartItems = () => {
   
    let ids = store.cart.map(x => x.id)

    axios.post('/api/v1/cart', {ids: ids})
        .then((res) => {

            title.value = res.data.title
            breadcrumbs.value = res.data.breadcrumbs

            cart.value = store.cart.map(x => {
                let obj = res.data.data.find(y => x.id === y.id)
                return {...obj, ...x}
            })

            if(itemsLength() === 0) selectAllItems()
        })
}

onMounted(() => {
    getCartItems()
})

const removeSelectedItems = () => {
    let items = store.selected
   

    if(items.length > 0) {
        console.log(Object.values(items))
        Object.values(items).forEach(id => {
            removeFromCart(id)
        })
    }
}

const removeFromCart = (id) => {
    store.removeItem(id)
    store.selectItem(id)
    
    let index = cart.value.findIndex(x => x.id === id)

    if(index >= 0) {
        cart.value.splice(index, 1)

        // let i = store.selected.findIndex(x => x === id)
        // selectedItems.value.splice(i, 1)
    }
}


const changeValue = (id, value) => {
    let index = cart.value.findIndex(x => x.id === id)

    if(index >= 0) {
        if(cart.value[index].count > 1 && value === -1) {
            let count = cart.value[index].count - 1
            cart.value[index].count = count
            store.setCount(id, count)
        }

        if(cart.value[index].count < 99 && value === 1) {
            let count = cart.value[index].count + 1
            cart.value[index].count = count
            store.setCount(id, count)
        }
    }
}

const changeInput = (e, id) => {
    let value = e.target.value.replace(' ', '').replace(/[^\.0-9]/g, '')
    let index = cart.value.findIndex(x => x.id === id)
    let count = value
    
    if(value == null || value == '' || !(value > 0 && value < 100)) {
        count = 1
    }

    cart.value[index].count = e.target.value = count
    store.setCount(id, count)
}

const getSums = (key) => {
    let items = itemsLength() > 0 ? cart.value.filter(x => checkSelect(x.id)) : []

    if(items.length > 0) {
        return items.map(x => x[key] * x.count).reduce((a, b) =>  a + b)
    } else {
        return 0
    }
}


const getPriceSum = () => {
    return getSums('price')
}

const getDiscountSum = () => {
    return getSums('discount')
}

const getTotalSum = () => {
    return getSums('discount_price')
}

const selectItem = (id) => {
    store.selectItem(id)
}

const selectAllItems = () => {
    store.selectAllItems(cart.value.map(x => x.id))
}

const checkSelect = (id) => {
    return store.selected.includes(id)
}

const itemsLength = () => {
    return store.selected.length
}

</script>
<template>
<Header/>
<Menu />
<div class="cart_block w-100 position-relative">
    <img class="position-absolute goods_bg" src="/svg/cart_bg.svg">
    <div class="bc_block m-auto w-100">
        <div class="breadcrumbs mb-5 ms-auto me-auto mt-5">
            <Breadcrumbs :items="breadcrumbs"/>
        </div>
    </div>
    <div class="contacts_text2 blue_color catalog_text2 m-0" v-html="title"></div>
    <div class="cart_screen me-auto ms-auto">
        <div class="cart_screen_text">
            <Breadcrumbs :items="breadcrumbs"/>
        </div>
        <span v-if="cart && cart.length > 0" class="wallpaper_screen_elem1_text blue_color" v-html="title" />
        <div v-if="cart && cart.length > 0" class="goods_block d-flex flex-row mt-5 position-relative">
            <div class="goods_elem1 me-2">
                <div class="goods_elem1_header">
                    <div class="goods_elem1_header_elem1 d-flex align-items-center justify-content-center white_color bg_blue"><span>Выбранные товары</span></div>
                    <div class="goods_elem1_header_elem2 d-flex align-items-center ps-4 bg_white">
                        <div class="me-4">
                            <input class="me-3 goods_input" type="checkbox" id="check_all" :checked="itemsLength() === cart.length" @change="selectAllItems">
                            <label for="check_all"></label>
                        </div>
                        <div class="h-100 d-flex align-items-center">
                            <div class="goods_elem1_header_elem2_text">
                                <span class="goods_elem1_header_elem2_t1 me-3 blue_color" role="button">
                                    <label for="check_all">Выбрать все для заказа</label>
                                </span>
                                <span class="goods_elem1_header_elem2_t2 pink_color" role="button" @click="removeSelectedItems">Удалить выбранное</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="goods_elem1_body">
                    <div class="goods_elem1_body_block d-flex justify-content-between align-items-center ps-4 pe-4 bg_white"
                        :class="{change_bg1: checkSelect(item.id)}"
                        v-for="item in cart"
                    >
                        <input class="me-3 goods_input" type="checkbox" :id="`check_${item.id}`" :value="item.id" :checked="checkSelect(item.id)" @change="() => selectItem(item.id)">
                        <label :for="`check_${item.id}`"></label>
                        <div class="position-relative">
                            <img class="goods_img z-2 position-relative" :class="{'s3_b_pink': item.has_discount, 's3_b_blue': !item.has_discount}" :src="item.image">
                            <img class="goods_sale position-absolute z-1" src="/svg/sale.svg" v-if="item.has_discount">
                            <div class="discount d-flex justify-content-center align-items-center bg_pink z-2" v-if="item.has_discount">
                                <span v-html="`-${item.discount_percent}%`" />
                            </div>
                        </div> 
                        <div class="goods_elem1_body_block_end d-flex flex-column justify-content-between">
                            <div class="goods_elem1_body_block_end_header d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-start justify-content-between">
                                    <router-link class="goods_elem1_header_text1 blue_color" 
                                         :class="{'pink_color': item.has_discount}" 
                                         v-html="item.title"
                                         :to="`/catalog/${item.catalog.url}/${item.id}`"
                                    />
                                    <span class="goods_elem1_header_text2 blue_color" 
                                         :class="{'pink_color': item.has_discount}" 
                                         v-html="item.description"
                                    />
                                </div>
                                <div class="position-relative display-none">
                                    <img class="goods_img z-0" :class="{s3_b_pink: item.has_discount}" :src="item.image">
                                    <div class="goods_disc position-absolute bg_pink" v-if="item.has_discount" v-html="`-${item.discount_percent}%`" />
                                </div>
                                <div class="goods_elem1_body_block_end_div2 d-flex justify-content-center align-items-center flex-row" v-if="item.stock > 0">
                                    <span class="end_div2_text1 blue_color me-1">В наличии:</span>
                                    <span class="end_div2_text2 pink_color" v-html="getStock(item.stock)"></span>
                                </div>
                                <div class="goods_elem1_body_block_end_div1 d-flex justify-content-center align-items-center gray_color2 bg_white border_gray" v-else>На заказ</div>
                            </div>
                            <div class="goods_elem1_body_block_end_footer d-flex w-100 justify-content-between">
                                <div class="goods_elem1_body_block_end_footer_b1 d-flex align-items-center">
                                    <div class="d-flex justify-content-center q_block">
                                        <button class="q-minus blue_color" :class="{'pink_color': item.has_discount}" @click="changeValue(item.id, -1)">-</button>
                                        <input class="quantity border-start-0 border-end-0 text-center blue_color" :class="{'pink_color': item.has_discount}" type="number" @input="(e) => changeInput(e, item.id)" :value="item.count" />
                                        <button class="q-plus blue_color" :class="{'pink_color': item.has_discount}" @click="changeValue(item.id, 1)">+</button>
                                    </div>
                                    <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="display-none float-end" @click="removeFromCart(item.id)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.25 9.375C5.25 9.03 5.53 8.75 5.875 8.75C6.22 8.75 6.5 9.03 6.5 9.375V16.875C6.5 17.2206 6.22 17.5 5.875 17.5C5.53 17.5 5.25 17.2206 5.25 16.875V9.375ZM8.375 9.375C8.375 9.03 8.655 8.75 9 8.75C9.345 8.75 9.625 9.03 9.625 9.375V16.875C9.625 17.2206 9.345 17.5 9 17.5C8.655 17.5 8.375 17.2206 8.375 16.875V9.375ZM11.5 9.375C11.5 9.03 11.78 8.75 12.125 8.75C12.47 8.75 12.75 9.03 12.75 9.375V16.875C12.75 17.2206 12.47 17.5 12.125 17.5C11.78 17.5 11.5 17.2206 11.5 16.875V9.375ZM2.125 17.5C2.125 18.8806 3.24437 20 4.625 20H13.375C14.7556 20 15.875 18.8806 15.875 17.5V7.5H2.125V17.5ZM10.875 2.5H7.125V1.875C7.125 1.52938 7.405 1.25 7.75 1.25H10.25C10.595 1.25 10.875 1.52938 10.875 1.875V2.5ZM15.875 2.5H12.125V1.25C12.125 0.56 11.565 0 10.875 0H7.125C6.435 0 5.875 0.56 5.875 1.25V2.5H2.125C1.435 2.5 0.875 3.06 0.875 3.75V5C0.875 5.69 1.43437 6.24937 2.12437 6.25H15.8763C16.5656 6.24937 17.125 5.69 17.125 5V3.75C17.125 3.06 16.565 2.5 15.875 2.5Z" fill="#00ADB5"/>
                                    </svg>
                                    <div class="d-flex flex-column align-items-start ms-3 goods_elem1_footer_text">
                                        <span class="goods_elem1_footer_text2" v-if="item.has_discount">{{ helper.getPrice(item.price * item.count) }} ₽</span>
                                        <span class="goods_elem1_footer_text1 blue_color" :class="{'pink_color': item.has_discount}">{{ helper.getPrice(item.discount_price * item.count) }} ₽</span>
                                    </div>
                                </div>
                                <span class="goods_elem1_header_elem2_t2 pink_color align-self-end cursor-pointer" @click="removeFromCart(item.id)">Удалить</span>

                                <div class="goods_elem1_body_block_end_footer_bottom_m display-none">
                                    <div class="goods_elem1_body_block_end_footer_bottom_m_text1 bg_pink">70 200 ₽</div>
                                    <div class="goods_elem1_body_block_end_footer_bottom_m_text2">140 200 ₽</div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="goods_elem2 s3_b_blue bg_white">
                <div class="goods_elem2_body_border1 position-absolute"></div>
                <div class="goods_elem2_body_border2 position-absolute"></div>
                <div class="goods_elem2_header d-flex align-items-center justify-content-center white_color bg_blue"><span class="goods_elem2_header_text1">Стоимость</span><span class="goods_elem2_header_text2">Итоговая стоимость</span></div>
                <div class="goods_elem2_body d-flex justify-content-center align-items-center">
                    <div class="goods_elem2_body_center d-flex flex-column align-items-center justify-content-between">
                        <div>
                            <span class="blue_color" :class="{'gray_color2': itemsLength() === 0}">Цена: {{ helper.getPrice(getPriceSum()) }} ₽</span>
                        </div>

                        <div>
                            <span 
                                :class="{'gray_color2': getDiscountSum() === 0,'blue_color': getDiscountSum() > 0}"
                            >
                                Скидка: <span :class="{'pink_color': getDiscountSum() > 0}">{{ helper.getPrice(getDiscountSum()) }} ₽</span>
                            </span>
                        </div>

                        <div>
                            <span class="blue_color" :class="{'gray_color2': itemsLength() === 0}">Итого: <span :class="{'pink_color': itemsLength() > 0 && getDiscountSum() > 0}">{{ helper.getPrice(getTotalSum()) }} ₽</span></span>
                            
                        </div>
                    </div>
                </div>
                <div class="goods_elem2_footer d-flex align-items-center justify-content-center">
                    <router-link to="/catalog/cart/order" class="white_color bg_pink" v-if="itemsLength() > 0">
                        <span class="goods_elem2_footer_text1">Заказать выбранные товары</span>
                        <span class="goods_elem2_footer_text2">Оформить заказ</span>
                    </router-link>

                    <button class="white_color bg_pink" disabled="true" v-else>
                        <span class="goods_elem2_footer_text1">Выберите товары для заказа</span>
                        <span class="goods_elem2_footer_text2">Выберите товары</span>
                    </button>
                </div>
            </div>
        </div>

        <div v-if="cart && cart.length === 0" class="cart_screen_block d-flex flex-column align-items-center justify-content-evenly">
            <span class="blue_color">Корзина пуста</span>
            <div class="cart_screen_elem blue_color">
                Добавьте товары из <span class="pink_color"><router-link to="/catalog">каталога</router-link></span>, чтобы оформить заказ
            </div>
        </div>

        <Loader v-if="!cart" />
    </div>
</div>
<Footer/>
</template>