import './bootstrap'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'vue3-carousel/dist/carousel.css'
import Vue from "vue"
import App from './Dashboard.vue'
import VueSweetalert2 from 'vue-sweetalert2'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import router from './router/dashboard'

const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)


const app = createApp(App)

app.use(pinia)
app.use(router)
app.use(VueSweetalert2)


app.mount('#app');
