import './bootstrap'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'vue3-carousel/dist/carousel.css'
import App from './Dashboard.vue'
import VueSweetalert2 from 'vue-sweetalert2'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import router from './router/dashboard'
import { useProfileStore } from '@js/stores/profileStore'

const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)

const app = createApp(App)

app.use(pinia)
app.use(router)
app.use(VueSweetalert2)

const profile = useProfileStore()

axios.interceptors.request.use(function (config) {
    const token = profile.token;
    config.headers.Authorization = 'Bearer ' + token;
    return config;
})

axios.interceptors.response.use(response => {
    return response;
}, error => {
    if (error.response.status === 401) {
        router.push({name: 'Login'})
    }

    return error;
});

app.mount('#app');
