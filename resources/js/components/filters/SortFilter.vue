<script setup>
const emit = defineEmits(['filterSortBy'])
const filterSortBy = (e) => {
    emit('filterSortBy', e.target.value);
}
</script>

<template>
    <div class="ml-4 flex items-center">
        <p class="text-sm text-gray-600">Sort by: </p>
        <select name="sortBy" id="sort-by"
                @change="filterSortBy"
                class="h-full ml-2 rounded-sm text-gray-600 border border-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs">
            <option value="">-</option>
            <option value="amount">Amount</option>
        </select>
    </div>
</template>
