import { createWebHistory, createRouter, } from "vue-router"
import Home from '@js/pages/Home.vue'
import About from '@js/pages/About.vue'
import Contacts from '@js/pages/Contacts.vue'
import Requisites from '@js/pages/Requisites.vue'
import Offer from '@js/pages/Offer.vue'
import Policy from '@js/pages/Policy.vue'
import Items from '@js/pages/Items.vue'
import ItemPage from '@js/pages/ItemPage.vue'
import Cart from '@js/pages/Cart.vue'
import Delivery from '@js/pages/Delivery.vue'
import Payment from '@js/pages/Payment.vue'
import Order from '@js/pages/Order.vue'

const routes = [
    { 
        path: '/',
        component: Home,
        name: 'home',
    },

    {
        path: '/about',
        component: About,
        name: 'about',
    },

    { 
        path: '/contacts',
        component: Contacts,
        name: 'contacts',
    },

    { 
        path: '/requisites',
        component: Requisites,
        name: 'requisites',
    },

    { 
        path: '/public_offer',
        component: Offer,
        name: 'offer',
    },

    { 
        path: '/privacy_policy',
        component: Policy,
        name: 'policy',
    },

    { 
        path: '/delivery',
        component: Delivery,
        name: 'delivery',
    },

    { 
        path: '/payment',
        component: Payment,
        name: 'payment',
    },

    { 
        path: '/catalog/:section', 
        component: Items,
        name: 'catalog',
    },

    { 
        path: '/catalog/:section/:id', 
        component: ItemPage,
        name: 'item',
    },

    { 
        path: '/cart', 
        component: Cart,
        name: 'cart',
    },

    { 
        path: '/cart/order', 
        component: Order, 
        name: 'order' 
    },
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
