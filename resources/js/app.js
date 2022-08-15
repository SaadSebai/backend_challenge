import './bootstrap';
import { createApp } from 'vue';
import router from './router';
import Products from './components/products/Products.vue';

const app = createApp({
    components: { Products }
})
.use(router)
.mount('#app')
