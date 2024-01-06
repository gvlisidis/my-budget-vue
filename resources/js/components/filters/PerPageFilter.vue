<script setup>
import {toRef} from "vue";

const emit = defineEmits(['filterPerPage']);
const props = defineProps(['perPage']);
const perPage = toRef(props, 'perPage');
const filterPerPage = (e) => {
    emit('filterPerPage', e.target.value);
}
</script>

<template>
    <div class="h-full flex items-center">
        <p class="text-xs text-gray-600">Results per page: </p>
        <select name="perPage"
                @change="filterPerPage"
                v-model="perPage"
                class="ml-2 h-full rounded-sm text-gray-600 border border-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
        </select>
    </div>
</template>
