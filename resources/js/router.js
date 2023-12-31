import { createWebHistory, createRouter } from "vue-router"
import Home from '@js/pages/Home.vue'
import About from '@js/pages/About.vue'
import Contacts from '@js/pages/Contacts.vue'
import Catalog from '@js/pages/Catalog.vue'
import Dashboard from '@js/pages/dashboard/index.vue'

import auth from '@js/middleware/auth'

const routes = [
    { path: '/', component: Home },
    { path: '/about', component: About },
    { path: '/contacts', component: Contacts },
    { path: '/catalog', component: Catalog },

    {
        name: 'Dashboard',
        path: '/dashboard',
        component: Dashboard,
        meta: {
            middleware: auth
        },

        // redirect: { name: 'Desktop' },
        // children: [
        //     {
        //         name: 'Desktop',
        //         path: 'desktop',
        //         component: Desktop,
        //         // meta: {
        //         //     middleware: auth
        //         // },
        //     },
        // ]
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
