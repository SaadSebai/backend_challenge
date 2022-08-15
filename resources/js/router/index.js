import { createRouter, createWebHistory } from 'vue-router'
import Products from '../components/products/Products.vue';


const routes = [
    {
        path: '/',
        name: 'products',
        component: Products
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
