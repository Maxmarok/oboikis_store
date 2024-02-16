import { createWebHistory, createRouter } from "vue-router"
import Home from '@js/pages/Home.vue'
import About from '@js/pages/About.vue'
import Contacts from '@js/pages/Contacts.vue'
import Items from '@js/pages/Items.vue'
import ItemPage from '@js/pages/ItemPage.vue'
import Cart from '@js/pages/Cart.vue'
import Delivery from '@js/pages/Delivery.vue'
import Payment from '@js/pages/Payment.vue'
import Order from '@js/pages/Order.vue'

const routes = [
    { path: '/', component: Home },
    { path: '/about', component: About },
    { path: '/contacts', component: Contacts },

    { path: '/delivery', component: Delivery },
    { path: '/payment', component: Payment },

    { 
        path: '/catalog', 
        component: Items,
    },

    { 
        path: '/catalog/:section', 
        component: Items,
    },

    { 
        path: '/catalog/:section/:id', 
        component: ItemPage,
    },

    { path: '/catalog/cart', component: Cart },
    { path: '/catalog/cart/order', component: Order, name: 'order' },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        // always scroll to top
        return { top: 0 }
    },
})

export default router
