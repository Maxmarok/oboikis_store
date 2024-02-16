import { createWebHistory, createRouter } from "vue-router"
import Dashboard from '@js/pages/dashboard/index.vue'
import DashboardOrders from '@js/pages/dashboard/orders.vue'
import DashboardItems from '@js/pages/dashboard/items.vue'
import DashboardInfo from '@js/pages/dashboard/info.vue'

import auth from '@js/middleware/auth'

const routes = [
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
