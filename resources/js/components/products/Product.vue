<template>
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <td class="py-4 px-6">
            {{ product.name }}
        </td>
        <td class="py-4 px-6">
            {{ product.description }}
        </td>
        <td class="py-4 px-6">
            {{ product.price }}$
        </td>
        <td class="py-4 px-6" :class="{ 'text-red-500': !product.category.name }">
            {{ product.category.name ?? 'Uncategorized' }}
        </td>
        <td class="py-4 px-6">
            <img :src="product.image" class="object-contain h-20 w-20 ">
        </td>
    </tr>
</template>

<script>
export default {
    props: {
        product: Object
    }
}
</script>
