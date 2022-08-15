<template>

    <p class="text-green-500 mb-2 font-bold">{{ message }}</p>

    <button
        class="bg-green-600 p-0.5 text-white rounded-lg m-1"
        @click="create = !create"
    >
        New Product
    </button>
    <product-create
        v-show="create"
        @created="create = false, message = $event"
    />

    <products-list
        :products="products"
        @filter="filter($event)"
        @removeFilter="removeFilter()"
        @sort="sort($event)"
    />

    <pagination
        :current-page="current_page"
        :total-pages="total_pages"
        @paginate="selectPage($event)"
    />

</template>

<script>
import axios from 'axios';
import Pagination from '../shared/Pagination.vue';
import ProductsList from './ProductsList.vue';
import ProductCreate from './ProductCreate.vue';

export default {
    components: { Pagination, ProductsList, ProductCreate },
    data() {
        return {
            products: [],
            current_page: 1,
            total_pages: 1,
            filters: [],
            sort_field: '',
            sort_order: 'asc',
            create: false,
            message: null
        }
    },
    mounted() {
        this.fetchProducts()
    },
    methods: {
        fetchProducts() {
            console.log(this.productUrl)
            axios.get(this.productUrl)
                .then(response => {
                    this.products = response.data.data,
                    this.current_page = response.data.meta.current_page,
                    this.total_pages = response.data.meta.links.length - 2
                })
                .catch(error => console.log(error))
        },
        selectPage(page_number) {
            if(page_number < 1 || page_number > this.total_pages) return;

            this.current_page = page_number
            this.fetchProducts()
        },
        filter(data) {
            this.filters = [data]
            this.fetchProducts()
        },
        removeFilter()
        {
            this.filters = []
            this.fetchProducts()
        },
        sort($data)
        {
            this.sort_order = this.sort_field == $data
                                ? (this.sort_order == 'asc'? 'desc' : 'asc')
                                : this.sort_order

            this.sort_field = $data
            this.fetchProducts()
        }
    },
    computed: {
        productUrl() {
            return '/api/products?page=' + this.current_page
                + (this.filters.length ? '&filters[category_id]=' + this.filters[0].category_id : '')
                + '&sortField=' + this.sort_field + '&sortOrder=' + this.sort_order
        }
    }
}
</script>
