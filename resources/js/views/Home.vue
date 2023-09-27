<template>
    <div>
        <div class="py-2 border-l border-custom-50 bg-custom-700 text-white flex items-center text-xxs sm:text-base px-6">
            <h3 class="font-semibold">Averages per Month:</h3>
            <div class="ml-10 ">
                <div class="flex space-x-3">
                    <div class="mr-3">Supermarket: 635.34</div><div>|</div>
                    <div class="mr-3">Amazon: 635.34</div><div>|</div>
                    <div class="mr-3">Childcare: 635.34</div><div>|</div>
                    <div class="mr-3">Fuel: 635.34</div>
                </div>
            </div>
        </div>
        <div class="py-2 border-b-2 border-custom-400 flex items-center text-sm">
            <div class="flex justify-between items-center px-4 ">
                <p class="mr-2">Year:</p>
                <select name="year" id="year" class="text-sm rounded text-gray-900 w-24">
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                </select>
            </div>
            <div class=" flex justify-between items-center px-4 ">
                <p class="mr-2">Month:</p>
                <select name="month" id="month" class="text-sm rounded text-gray-900 w-24">
                    <option v-for="(month, index) in months" :key="index">{{ month }}</option>
                </select>
            </div>
        </div>
    </div>

</template>

<script setup>
import {ref} from "vue";

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
</script>

<style scoped>

</style>
