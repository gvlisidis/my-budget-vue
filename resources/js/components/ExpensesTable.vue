<template>
    <table class="table table-auto w-full text-left">
        <thead>
        <tr class="border-2 border-custom-400 bg-custom-600 text-white  text-base">
            <th class=" font-semibold border-r border-custom-gray p-2">Label</th>
            <th class="text-center font-semibold border-r border-custom-gray p-2">Amount</th>
            <th class="text-center font-semibold border-r border-custom-gray p-2">Category</th>
            <th class="text-center font-semibold border-r border-custom-gray p-2">Type</th>
            <th class="text-center font-semibold border-r border-custom-gray p-2">Date Issued</th>
            <th class="text-center font-semibold border-r border-custom-gray p-2">Actions</th>
        </tr>
        </thead>
        <tbody class="border-2 border-gray-300 text-sm">

        <tr v-if="expenses.data" v-for="expense in expenses.data" :key="expense.id" class="border-b border-gray-300 hover:bg-gray-100">
            <td class=" p-2">{{ expense.label }}</td>
            <td class="text-center p-2" :class="expense.type === 1 ?' text-red-600 ' : ' text-green-600 ' ">
                {{ formattedAmount(expense.amount) }}
            </td>
            <td class="text-center p-2">
                {{ expense.category.name }}
            </td>
            <td class="text-center p-2" :class="expense.type === 1 ?' text-red-600 ' : ' text-green-600 ' ">
                {{ formattedType(expense.type) }}
            </td>
            <td class="text-center p-2">
                {{ formattedIssuedAt(expense.issued_at) }}
            </td>
            <td class="p-2 flex justify-center space-x-4">
                <router-link :to="{ name: 'expense-edit', params: { id: expense.id } }"
                             class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">Edit
                </router-link>
                <button
                    @click.prevent="handleDelete(expense.id)"
                    class="font-semibold bg-red-500 hover:bg-red-600 text-white  py-2 px-4 rounded">
                    Delete
                </button>
            </td>
        </tr>
        <tr v-else>
            <td class="p-6">No expenses yet</td>
        </tr>
        </tbody>
    </table>
</template>

<script setup>
import moment from "moment/moment";
import axios from "axios";
import {useRouter} from "vue-router";

const props = defineProps(['expenses'])
const emit = defineEmits(['deleteExpense'])
const router = useRouter();

const formattedAmount = (amount) => {
    const newAmount = (amount / 100);
    return  new Intl.NumberFormat('en-Us', {
        style: 'currency',
        currency: 'GBP',
    }).format(newAmount);
}

const formattedType = (type) => {
    return type === 1 ? 'Debit' : 'Credit';
}

const formattedIssuedAt = (date) => {
    return moment(date, "YYYY-MM-DD").format("DD/MM/YYYY");
}

const handleDelete = (id) => {
    axios.delete(`/api/expenses/${id}`)
        .then((res) => {
            emit('deleteExpense')
            router.push({
                name: 'expense-index'
            });
        })
        .catch((error) => {
            console.log(error);
        })
}
// import dayjs from "dayjs";
//
// const formatDate = (dateString) => {
//     const date = dayjs(dateString);
//     // Then specify how you want your dates to be formatted
//     return date.format('DD/MM/YYYY');
// }

</script>
