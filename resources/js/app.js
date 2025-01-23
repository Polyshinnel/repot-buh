import './bootstrap';
import {createApp} from 'vue';
import App from './src/components/App.vue';
import router from './src/router/router.js';
import '@/assets/css/style.scss'

createApp(App)
    .use(router)
    .mount('#app')
