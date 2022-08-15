<template>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">
            Category
        </label>
        <select @change="$emit('setCategory', $event.target.value)"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="category_id"
        >
            <option value="" selected>---Category---</option>
            <option v-for="category in categories"
                :value="category.id"
                :key="category.id"
            >
                {{ category.name }}
            </option>
        </select>
    </div>
</template>

<script>

export default {
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
