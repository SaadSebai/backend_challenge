<template>
    <div class="w-full max-w-xs">
        <p v-show="error" class="text-red-500 mb-2 font-bold">{{ error }}</p>
        <form @submit.prevent="createProduct"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
        >
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>
                <input input v-model="name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="name" type="text" placeholder="Name"
                >
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea input v-model="description"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="description" type="text" placeholder="Description"
                >
                </textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                    Price
                </label>
                <input input v-model="price"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="price" type="number" placeholder="Price"
                >
            </div>

            <categories-select @setCategory="category_id = $event" />

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                    Image
                </label>
                <input input @change="setImage"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="price" type="file" placeholder="Image"
                >
            </div>

            <div class="flex items-center justify-between">
                <button
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Create
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import CategoriesSelect from '../categories/CategoriesSelect.vue';

export default {
    components: { CategoriesSelect },
    data() {
        return {
            name: '',
            description: '',
            price: 0,
            category_id: null,
            image: null,
            error: null
        }
    },
    methods: {
        setImage(e)
        {
            this.image = e.target.files[0]
        },
        createProduct()
        {
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let data = new FormData();

            data.append('name', this.name)
            data.append('description', this.description)
            data.append('price', this.price)
            data.append('category_id', this.category_id)
            data.append('image', this.image)

            axios.post('/api/products', data, config)
                .then(response => {
                    this.$emit('created', response.data.message)

                    this.name =  ''
                    this.description =  ''
                    this.price =  0
                    this.category_id =  null
                    this.image =  null
                    this.error = null
                })
                .catch(error => {
                    this.error = error.response.data.message
                    console.log(error.response.data.message)
                })

        }
    }
}

</script>
