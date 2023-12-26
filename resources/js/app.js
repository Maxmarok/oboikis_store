import './bootstrap'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'vue3-carousel/dist/carousel.css'
import App from './App.vue'
import { createApp } from 'vue'
import router from './router'


const app = createApp(App)

app.use(router)


app.mount('#app');
