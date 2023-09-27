<template>

</template>

<script setup>
import dayjs from "dayjs";

const formatDate = (dateString) => {
    const date = dayjs(dateString);
    // Then specify how you want your dates to be formatted
    return date.format('DD/MM/YYYY');
}

</script>
