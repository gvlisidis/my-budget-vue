<template>
    <div class="">
        <div class="flex flex-col space-y-1 text-xs">
            <div class="grid grid-cols-2 gap-x-4">
                <p class="">Total credit:</p>
                <p class="text-blue-600 ml-2 text-left">
                    &#163;{{ totalMonthCredit }}</p>
            </div>
            <div class="grid grid-cols-2 gap-x-4">
                <p class="">Total debit:</p>
                <p class="text-stone-600 ml-2 text-left">
                    &#163;{{ totalMonthDebit }}</p>
            </div>
            <div class="grid grid-cols-2 gap-x-4">
                <p class="">Balance:</p>
                <p class=" ml-2 text-left" :class="isCredit ? 'text-green-600' : 'text-red-600'">
                    &#163; {{ balance }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps(['totalMonthCredit', 'totalMonthDebit', 'isCredit', 'balance'])
</script>
