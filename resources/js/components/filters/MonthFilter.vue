<script setup>
import {ref, toRef} from "vue";
const props = defineProps(['selectedMonth']);
const selectedMonth = toRef(props, 'selectedMonth');

const months = ref([
    'Jan',
    'Feb',
    'Mar',
    'Apr',
    'May',
    'Jun',
    'Jul',
    'Aug',
    'Sep',
    'Oct',
    'Nov',
    'Dec',
]);

const emit = defineEmits(['filterMonth'])
const filterMonth = (e) => {
    emit('filterMonth', e.target.value);
}
</script>

<template>
    <div class="ml-4 flex items-center">
        <p class="text-sm text-gray-600">Month: </p>
        <select
            name="month" id="month"
            v-model="selectedMonth"
            @change="filterMonth"
            class="h-full ml-2 rounded-sm text-gray-600 border border-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs">
            <option value="13">All</option>
            <option v-for="(month, index) in months" :value="index + 1" :key="index">{{ month }}</option>
        </select>
    </div>
</template>
