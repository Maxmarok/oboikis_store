import { createWebHistory, createRouter } from "vue-router"
import Home from '@js/pages/Home.vue'
import About from '@js/pages/About.vue'
import Contacts from '@js/pages/Contacts.vue'
import Catalog from '@js/pages/Catalog.vue'
import Items from '@js/pages/Items.vue'
import ItemPage from '@js/pages/ItemPage.vue'
import Cart from '@js/pages/Cart.vue'
import Delivery from '@js/pages/Delivery.vue'
import Payment from '@js/pages/Payment.vue'
import Order from '@js/pages/Order.vue'

import Dashboard from '@js/pages/dashboard/index.vue'
import DashboardOrders from '@js/pages/dashboard/orders.vue'
import DashboardItems from '@js/pages/dashboard/items.vue'
import DashboardInfo from '@js/pages/dashboard/info.vue'


import auth from '@js/middleware/auth'

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

    {
        name: 'Dashboard',
        path: '/dashboard',
        component: Dashboard,
        meta: {
            middleware: auth
        },

        // redirect: { name: 'Desktop' },
        children: [
            {
                name: 'Orders',
                path: 'orders',
                component: DashboardOrders,
                // meta: {
                //     middleware: auth
                // },
            },

            {
                name: 'Items',
                path: 'items',
                component: DashboardItems,
                // meta: {
                //     middleware: auth
                // },
            },

            {
                name: 'Info',
                path: 'info',
                component: DashboardInfo,
                // meta: {
                //     middleware: auth
                // },
            },
        ]
    }
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
