<script setup>
const emit = defineEmits(['search']);

const search = (e) => {
    emit('search', e.target.value);
}
</script>

<template>
    <input
        autocomplete="off"
        @input="search"
        type="search" name="search"
        placeholder="Search for... "
        class="h-8 rounded-sm shadow-sm text-gray-600 px-3 border border-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs"/>
</template>
