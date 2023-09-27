import {defineStore} from "pinia";
import {ref} from "vue";
import axios from "axios";


export const useExpensesStore = defineStore('expenses', () => {
    const expenses = ref([]);
    const selectedYear = ref(null)
    const selectedMonth = ref(null)
    const getExpenses = async () => {
        await axios.get('/api/expenses', {
            params: {
                month: selectedMonth.value,
                year: selectedYear.value
            }
        })
            .then((res) => {
                expenses.value = res.data.data
            })
            .catch((error) => {
                console.log(error);
            })
    }

    return {
        expenses, selectedMonth, selectedYear, getExpenses
    }
});
