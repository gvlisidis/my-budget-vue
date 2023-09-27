<template>
    <div class="p-3">
        <div class="mx-auto w-full">
            <div class="bg-white shadow-sm rounded-sm ">
                <div class="border-b-2 border-custom-700 flex items-center justify-between">
                    <p class="p-6 text-2xl font-semibold text-custom-800">Categories</p>
                    <div class="p-6">
                        <a href="#"
                           class="text-base bg-custom-400 hover:bg-custom-500 text-white py-2 px-4 rounded-md">Create</a>
                    </div>
                </div>

                <div>
                    <div v-if="categories.length > 0" v-for="(category, index) in categories" :key="index" class="bg-white border-b border-gray-100 flex items-center justify-between">
                        <p
                            class="w-80 px-6 py-4 font-medium text-gray-900 flex items-center">
                            {{ category.name}}
                        </p>
                        <div class="py-4 px-6 flex items-center space-x-4">
                            <router-link :to="{ name: 'category-edit', params: { id: category.id } }"
                                         class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">Edit
                            </router-link>
                            <button
                                @click.prevent="handleDelete(category.id)"
                                class="font-semibold bg-red-500 hover:bg-red-600 text-white  py-2 px-4 rounded">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {onMounted} from "vue";
import {useCategories} from "../../composables/categories";

const { categories, getCategories } = useCategories()
onMounted( () => {
    getCategories()
});

</script>
