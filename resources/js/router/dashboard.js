import { createWebHistory, createRouter } from "vue-router"
import Dashboard from '@js/pages/dashboard/index.vue'
import DashboardOrders from '@js/pages/dashboard/orders.vue'
import DashboardItems from '@js/pages/dashboard/items.vue'
import DashboardInfo from '@js/pages/dashboard/info.vue'
import Login from '@js/pages/dashboard/login.vue'

import auth from '@js/middleware/auth'
import middlewarePipeline from "@js/middleware/middleware-pipeline"

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
    },

    {
        name: 'Login',
        path: '/dashboard/login',
        component: Login,
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

router.beforeEach((to, from, next) => {

    if (!to.meta.middleware) {
        return next()
    }
    
    const middleware = Array.isArray(to.meta.middleware)
    ? to.meta.middleware
    : [to.meta.middleware];

    const context = {
        to,
        from,
        next,
    };

    return middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1),
    });
})



export default router
