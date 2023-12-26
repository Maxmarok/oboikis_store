import { createWebHistory, createRouter } from "vue-router"
import Home from '@js/pages/Home.vue'
import About from '@js/pages/About.vue'
import Contacts from '@js/pages/Contacts.vue'
import Catalog from '@js/pages/Catalog.vue'

const routes = [
    { path: '/', component: Home },
    { path: '/about', component: About },
    { path: '/contacts', component: Contacts },
    { path: '/catalog', component: Catalog },
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
