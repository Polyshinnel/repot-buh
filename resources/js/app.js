import './bootstrap';
import {createApp} from 'vue';
import App from './src/components/App.vue';
import router from './src/router/router.js';
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import '@/assets/css/style.scss'

createApp(App)
    .use(router)
    .use(ElementPlus)
    .mount('#app')
