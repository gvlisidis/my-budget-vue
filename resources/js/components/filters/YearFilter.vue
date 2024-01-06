<script setup>
import {toRef} from "vue";

const props = defineProps(['selectedYear'])
const selectedYear = toRef(props, 'selectedYear');

const emit = defineEmits(['filterYear'])
const filterYear = (e) => {
    emit('filterYear', e.target.value);
}
</script>

<template>
    <div class="ml-4 flex items-center">
        <p class="text-sm text-gray-600">Year: </p>
        <select name="year" id="year"
                @change="filterYear"
                v-model="selectedYear"
                class="h-full ml-2 rounded-sm text-gray-600 border border-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs">
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
        </select>
    </div>
</template>
