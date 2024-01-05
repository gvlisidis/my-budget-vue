<template>
    <div class="p-3">
        <div class="font-semibold flex items-center justify-between">
            <div class="flex space-x-4">
                <p class="text-3xl font-semibold text-custom-900">Expenses</p>
            </div>
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
            <div class="flex space-x-4">
                <router-link to="/expenses/import-file" class="text-sm bg-custom-400 hover:bg-custom-500 text-white py-2 px-4 rounded">Import from file</router-link>
                <router-link to="/expenses/import-manually" class="text-sm bg-custom-400 hover:bg-custom-500 text-white py-2 px-4 rounded">Import Manually</router-link>
            </div>
        </div>
    </div>
    <div class="mt-10 px-6">
        <div class="mt-2 mb-4 flex justify-between items-center ">
            <div class="h-full flex items-center">
                <input
                    autocomplete="off"
                    v-model="searchTerm"
                    type="search" name="search"
                    placeholder="Search for... "
                    class="h-8 rounded-sm shadow-sm text-gray-600 px-3 border border-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs"/>
                <div class="ml-4 flex items-center">
                    <p class="text-sm text-gray-600">Category: </p>
                    <select
                        name="selectedCategory" id="selectedCategory"
                        v-model="selectedCategory"
                        class="h-full ml-2 rounded-sm text-gray-600 border border-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs">
                        <option value="all">All</option>
                        <option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
                    </select>
                </div>
                <div class="ml-4 flex items-center">
                    <p class="text-sm text-gray-600">Type: </p>
                    <select  name="type" id="type"
                             v-model="selectedType"
                             class="h-full ml-2 rounded-sm text-gray-600 border border-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs">
                        <option value="all">All</option>
                        <option value="1">Debit</option>
                        <option value="2">Credit</option>
                    </select>
                </div>
                <div class="ml-4 flex items-center">
                    <p class="text-sm text-gray-600">Month: </p>
                    <select
                        name="month" id="month"
                        v-model="selectedMonth"
                        class="h-full ml-2 rounded-sm text-gray-600 border border-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs">
                        <option value="13">All</option>
                        <option v-for="(month, index) in months" :value="index + 1" :key="index">{{ month }}</option>
                    </select>
                </div>
                <div class="ml-4 flex items-center">
                    <p class="text-sm text-gray-600">Year: </p>
                    <select name="year" id="year"
                            v-model="selectedYear"
                            class="h-full ml-2 rounded-sm text-gray-600 border border-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs">
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                    </select>
                </div>
                <div class="ml-4 flex items-center">
                    <p class="text-sm text-gray-600">Sort by: </p>
                    <select name="sortBy" id="sort-by"
                            v-model="sortBy"
                            class="h-full ml-2 rounded-sm text-gray-600 border border-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs">
                        <option value="">-</option>
                        <option value="amount">Amount</option>
                    </select>
                </div>
            </div>
            <div class="h-full flex items-center">
                <p class="text-xs text-gray-600">Results per page: </p>
                <select name="perPage"
                        v-model="perPage"
                        class="ml-2 h-full rounded-sm text-gray-600 border border-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>
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
        <div class="mt-6 w-full flex items-center justify-center">
            <TailwindPagination
                :data="expenses"
                :limit="10"
                @pagination-change-page="getExpenses"/>
        </div>
    </div>
</template>

<script setup>
import {onMounted, ref, watch} from "vue";
import axios from "axios";
import {TailwindPagination} from "laravel-vue-pagination";
import {useCategories} from "../../composables/categories";
import moment from "moment";
import {useRouter} from "vue-router";

const expenses = ref([]);
const selectedYear = ref(new Date().getFullYear()-2);
const selectedCategory = ref("all");
const selectedType = ref("all");
const selectedMonth = ref(new Date().getMonth()+13);
const sortBy = ref("");
const perPage = ref(30);
const searchTerm = ref("");
const totalMonthDebit = ref(null);
const totalMonthCredit = ref(null);
const balance = ref(null);
const isCredit = ref(false);
const router = useRouter();

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

const { categories, getCategories } = useCategories();

onMounted(async () => {
    await getExpenses();
    await getCategories();
    await getTotals();
})

const formattedType = (type) => {
    return type === 1 ? 'Debit' : 'Credit';
}

const formattedIssuedAt = (date) => {
    return moment(date, "YYYY-MM-DD").format("DD/MM/YYYY");
}

const formattedAmount = (amount) => {
    const newAmount = (amount / 100);
    return  new Intl.NumberFormat('en-Us', {
        style: 'currency',
        currency: 'GBP',
    }).format(newAmount);
}

watch(
    [selectedYear, selectedMonth, sortBy, selectedCategory, searchTerm, selectedType, perPage],
    ([newYear, newMonth, newSort, newCategory, newSearchTerm, newSelectedType, newPerPage], [oldYear, oldMonth, oldSort, oldCategory, oldSearchTerm, oldSelectedType, oldPerPage]) => {
        getExpenses();
        getTotals();
    })

const getExpenses = async (page = 1) => {
    await axios.get(`/api/expenses?page=${page}`, {
        params: {
            month: selectedMonth.value,
            year: selectedYear.value,
            sortBy: sortBy.value,
            category: selectedCategory.value,
            searchTerm: searchTerm.value,
            type: selectedType.value,
            perPage: perPage.value
        }
    })
        .then((res) => {
            expenses.value = res.data
        })
        .catch((error) => {
            console.log(error);
        })
}

const getTotals = async () => {
    await axios.get('/api/totals', {
        params: {
            month: selectedMonth.value,
            year: selectedYear.value,
        }
    })
        .then((res) => {
            totalMonthCredit.value = res.data.totalMonthCredit
            totalMonthDebit.value = res.data.totalMonthDebit
            balance.value = res.data.balance
            isCredit.value = res.data.is_credit
        })
        .catch((error) => {
            console.log(error);
        })
}

const handleDelete = (id) => {
    axios.delete(`/api/expenses/${id}`)
        .then((res) => {
            getExpenses();
            router.push({
                name: 'expense-index'
            });
        })
        .catch((error) => {
            console.log(error);
        })
}

</script>
