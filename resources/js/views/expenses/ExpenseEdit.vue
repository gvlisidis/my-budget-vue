<template>
    <div class="py-12" v-if="expense && categories">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg h-fit p-10 ">
                <div class="mb-4 text-sm">
                    <div v-show="successMessage" class=" bg-green-200 opacity-75 rounded w-full py-2 px-4"><p class="text-gray-900">{{ successMessage }}</p></div>
                    <div v-show="errorMessage" class="bg-red-200 opacity-75 rounded w-full py-2 px-4"><p class="text-gray-900">{{ errorMessage }}</p></div>
                </div>
                <form class="space-y-10">
                    <div class="flex space-x-6">
                        <div class="flex flex-col space-y-1">
                            <label for="label" class="font-semibold">Label</label>
                            <input type="text" id="label" name="label" class="rounded-sm text-gray-700 px-3 w-96"
                                   v-model="expense.label"/>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="category_id" class="font-semibold">Category</label>
                            <select name="category_id" id="category_id" class="rounded-sm text-gray-700 w-72"
                                    v-model="expense.category.id">
                                <option v-for="(category, index) in categories" :value="category.id" :key="index">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="amount" class="font-semibold">Amount</label>
                            <input type="number" id="amount" name="amount" class="rounded-sm text-gray-700 px-3 w-60"
                                   v-model="expense.amount"/>
                        </div>
                    </div>

                    <div class="flex space-x-6">
                        <div class="flex flex-col space-y-1">
                            <label for="issued_at" class="font-semibold">Date Issued</label>
                            <input type="date" id="issued_at" name="issued_at"
                                   class="rounded-sm text-gray-700 px-3 w-96" v-model="expense.issued_at"/>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="type" class="font-semibold">Type</label>
                            <select name="type" id="type" class="rounded-sm text-gray-700 w-72" v-model="expense.type">
                                <option value="1">Debit</option>
                                <option value="2">Credit</option>
                            </select>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="user_id" class="font-semibold">User</label>
                            <select name="user_id" id="user_id" class="rounded-sm text-gray-700 w-72"
                                    v-model="expense.user.id">
                                <option v-for="(user, index) in users" :key="index" :value="user.id">{{ user.name }}</option>
                            </select>
                        </div>
                    </div>

                    <button class="font-medium bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-sm"
                            type="submit" @click.prevent="handleSubmit">Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import {onMounted, ref} from "vue";
import axios from "axios";
import {useCategories} from "../../composables/categories";
import {useRouter} from "vue-router";

const props = defineProps({
    id: {
        required: true,
    },
})
const users = ref([]);
const router = useRouter();
const successMessage = ref('');
const errorMessage = ref('');
const expense = ref(null);
const { categories, getCategories } = useCategories();

onMounted(async () => {
    await getExpense()
    await getCategories()
    await getUsers()
})

const getExpense = async () => {
   await axios.get(`/api/expenses/${props.id}/edit`)
        .then((response) => {
            expense.value = response.data.data
        })
        .catch((error) => {
            console.log(error)
        })
}

const getUsers = async () => {
    await axios.get('/api/users')
        .then((response) => {
            users.value = response.data.data
        })
        .catch((error) => {
            console.log(error)
        })
}

const handleSubmit = async () => {
    await axios.put(`/api/expenses/${props.id}`, {
        label: expense.value.label,
        category_id: expense.value.category.id,
        user_id: expense.value.user.id,
        type: expense.value.type,
        issued_at: expense.value.issued_at,
        amount: expense.value.amount
    })
        .then((res) => {
            successMessage.value = res.data.message;

            setTimeout(() => {
                router.push({
                    name: 'expense-index'
                })
            }, 2000)
        })
        .catch((error) => {
            errorMessage.value = error.response.data.message
            setTimeout(() => {
                errorMessage.value = '';
            }, 2000)
        })
}
</script>

