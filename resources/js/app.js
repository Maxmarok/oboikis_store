import './bootstrap'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'vue3-carousel/dist/carousel.css'
import Vue from "vue"
import App from './App.vue'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import router from './router'

const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)


const app = createApp(App)

app.use(pinia)
app.use(router)


app.mount('#app');
