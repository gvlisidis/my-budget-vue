<script setup>
const emit = defineEmits(['filterType'])
const filterType = (e) => {
    emit('filterType', e.target.value);
}

</script>

<template>
    <div class="ml-4 flex items-center">
        <p class="text-sm text-gray-600">Type: </p>
        <select  name="type" id="type"
                 @change="filterType"
                 class="h-full ml-2 rounded-sm text-gray-600 border border-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs">
            <option value="all">All</option>
            <option value="1">Debit</option>
            <option value="2">Credit</option>
        </select>
    </div>
</template>
