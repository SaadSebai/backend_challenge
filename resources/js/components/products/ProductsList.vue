<template>
    <div class="overflow-x-auto relative">
        <div>
            <button id="dropdownDefault" data-dropdown-toggle="dropdown"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">Categories<svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg></button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 block"
                data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(319px, 70px);">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                    <li  v-for="category in categories" :key="category.id">
                        <a href="#"
                            @click="$emit('filter', { category_id: category.id})"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            {{ category.name }}
                        </a>
                    </li>
                </ul>
            </div>
            <button
                class="bg-red-600 p-0.5 text-white rounded-lg m-1"
                @click="$emit('removeFilter')"
            >
                remove
            </button>
        </div>


        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        <a href="#" @click="$emit('sort', 'name')">
                            Name
                        </a>
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Description
                    </th>
                    <th scope="col" class="py-3 px-6">
                        <a href="#" @click="$emit('sort', 'price')">
                            Price
                        </a>
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Category
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Image
                    </th>
                </tr>
            </thead>
            <tbody v-for="product in products" :key="product.id">
                <product :product="product" />
            </tbody>
        </table>
    </div>
</template>

<script>

import Product from './Product.vue';

export default {
    components: { Product },
    props: {
        products: Array
    },
    data() {
        return {
            categories: [
                {
                    id: '',
                    name: 'Uncategorized'
                }
            ]
        }
    },
    mounted() {
        this.fetchCategories()
    },
    methods: {
        fetchCategories() {
            axios.get('/api/categories')
                .then(response => {
                    this.categories = this.categories.concat(response.data.data);
                })
                .catch(error => console.log(error))
        }
    }
}

</script>
