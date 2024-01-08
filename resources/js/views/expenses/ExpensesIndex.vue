<template>
    <div class="p-3">
        <div class="font-semibold flex items-center justify-between">
            <div class="flex space-x-4">
                <p class="text-3xl font-semibold text-custom-900">Expenses</p>
            </div>
            <Totals
                :totalMonthCredit="totalMonthCredit"
                :totalMonthDebit="totalMonthDebit"
                :isCredit="isCredit"
                :balance="balance"
            />
            <div class="flex space-x-4">
                <router-link to="/expenses/import-file" class="text-sm bg-custom-400 hover:bg-custom-500 text-white py-2 px-4 rounded">Import from file</router-link>
                <router-link to="/expenses/import-manually" class="text-sm bg-custom-400 hover:bg-custom-500 text-white py-2 px-4 rounded">Import Manually</router-link>
            </div>
        </div>
    </div>

    <div class="mt-10 px-6">
        <!--    Filters -->
        <div class="mt-2 mb-4 flex justify-between items-center ">
            <div class="h-full flex items-center">
                <SearchFilter @search="handleSearch"/>
                <CategoryFilter @filter-category="handleCategoryFilter" />
                <TypeFilter @filter-type="handleTypeFilter" />
                <MonthFilter :selectedMonth="selectedMonth" @filter-month="handleMonthFilter" />
                <YearFilter :selectedYear="selectedYear" @filter-year="handleYearFilter" />
                <SortFilter @filter-sort-by="handleSortByFilter" />
            </div>
            <PerPageFilter :perPage="perPage" @filter-per-page="handlePerPageFilter" />
        </div>
        <!--   End Filters -->

        <ExpensesTable
            :expenses="expenses"
            @delete-expense="getExpenses"
        />
        
        <div class="mt-6 w-full flex items-center justify-center">
            <TailwindPagination
                :data="expenses"
                :limit="10"
                @pagination-change-page="getExpenses"/>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref, watch} from "vue";
import axios from "axios";
import {TailwindPagination} from "laravel-vue-pagination";
import {useRouter} from "vue-router";
import Totals from "../../components/Totals.vue";
import ExpensesTable from "../../components/ExpensesTable.vue";
import SearchFilter from "../../components/filters/SearchFilter.vue";
import CategoryFilter from "../../components/filters/CategoryFilter.vue";
import TypeFilter from "../../components/filters/TypeFilter.vue";
import MonthFilter from "../../components/filters/MonthFilter.vue";
import YearFilter from "../../components/filters/YearFilter.vue";
import SortFilter from "../../components/filters/SortFilter.vue";
import PerPageFilter from "../../components/filters/PerPageFilter.vue";

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

onMounted(async () => {
    await getExpenses();
    await getTotals();
})

const handleSearch = (search) => {
    searchTerm.value = search;
};
const handleCategoryFilter = (category) => {
    selectedCategory.value = category
}
const handleTypeFilter = (type) => {
    selectedType.value = type
}
const handleMonthFilter = (month) => {
    selectedMonth.value = month
}
const handleYearFilter = (year) => {
    selectedYear.value = year
}
const handleSortByFilter = (sort) => {
    sortBy.value = sort
}
const handlePerPageFilter = (itemsPerPage) => {
    perPage.value = itemsPerPage
}

watch(
    [searchTerm, selectedCategory, selectedType, selectedMonth, selectedYear, sortBy, perPage],
    ([newSearchTerm, newCategory, newSelectedType, newMonth, newYear, newSort, newPerPage], [oldSearchTerm, oldCategory, oldSelectedType, oldMonth, oldYear, oldSort, oldPerPage]) => {
        getExpenses();

        if (newMonth || newYear){
            getTotals();
        }
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

</script>
