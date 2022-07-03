import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';

// scss
import '@/assets/css/_reset.scss';
import '@/assets/css/_variable.scss';
import '@/assets/css/_custom.scss';

createApp(App).use(store).use(router).mount('#app');
