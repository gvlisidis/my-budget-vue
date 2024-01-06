<script setup>
import {useCategories} from "../../composables/categories";
import {onMounted} from "vue";
const emit = defineEmits(['filterCategory'])

const { categories, getCategories } = useCategories();

onMounted(async () => {
    await getCategories();
})

const filterCategory = (e) => {
    emit('filterCategory', e.target.value);
}

</script>

<template>
    <div class="ml-4 flex items-center">
        <p class="text-sm text-gray-600">Category: </p>
        <select
            @change="filterCategory"
            name="selectedCategory" id="selectedCategory"
            class="h-full ml-2 rounded-sm text-gray-600 border border-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs">
            <option value="all" selected>All</option>
            <option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
        </select>
    </div>
</template>
