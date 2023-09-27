<template>

</template>


<script setup>
import {ref, toRefs} from "vue";

const props = defineProps({
    selectedYear: Number,
    selectedMonth: Number
});

const {selectedYear, selectedMonth} = toRefs(props)

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
