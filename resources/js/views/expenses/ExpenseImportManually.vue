<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg h-fit p-10 ">
                <div class="mb-4 text-sm">
                    <div v-show="successMessage" class=" bg-green-200 opacity-75 rounded w-full py-2 px-4"><p class="text-gray-900">{{ successMessage }}</p></div>
                    <div v-show="errorMessage" class="bg-red-200 opacity-75 rounded w-full py-2 px-4"><p class="text-gray-900">{{ errorMessage }}</p></div>
                </div>
                <form class="space-y-10" method="post">
                    <div class="flex space-x-6">
                        <div class="flex flex-col space-y-1">
                            <label for="label" class="font-semibold">Label</label>
                            <input type="text" id="label" name="label" class="rounded-sm text-gray-700 px-3 w-96"
                                   v-model="form.label"/>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="category_id" class="font-semibold">Category</label>
                            <select name="category_id" id="category_id" class="rounded-sm text-gray-700 w-72"
                                    v-model="form.category_id">
                                <option v-for="category in categories" :value="category.id" :key="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="amount" class="font-semibold">Amount</label>
                            <input type="number" id="amount" name="amount" class="rounded-sm text-gray-700 px-3 w-60"
                                   v-model="form.amount"/>
                        </div>
                    </div>

                    <div class="flex space-x-6">
                        <div class="flex flex-col space-y-1">
                            <label for="issued_at" class="font-semibold">Date Issued</label>
                            <input type="date" id="issued_at" name="issued_at"
                                   class="rounded-sm text-gray-700 px-3 w-96" v-model="form.issued_at"/>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="type" class="font-semibold">Type</label>
                            <select name="type" id="type" class="rounded-sm text-gray-700 w-72" v-model="form.type">
                                <option value="1">Debit</option>
                                <option value="2">Credit</option>
                            </select>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="user_id" class="font-semibold">User</label>
                            <select name="user_id" id="user_id" class="rounded-sm text-gray-700 w-72"
                                    v-model="form.user_id">
                                <option value="1">George</option>
                                <option value="2">Zina</option>
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
import {onMounted, reactive, ref} from "vue";
import axios from "axios";
import {useRouter} from "vue-router";
import {useCategories} from "../../composables/categories";
const successMessage = ref('');
const errorMessage = ref('');
const form = reactive({
    label: '',
    category_id: null,
    amount: null,
    issued_at: '',
    type: 1,
    user_id: 1
});
const router = useRouter();
const { categories, getCategories } = useCategories();


onMounted(() => {
    getCategories();
})
const handleSubmit = async () => {
    await axios.post('/api/expenses', form)
        .then((res) => {
            form.label = ''
            form.category_id = null
            form.amount = null
            form.issued_at = ''
            form.type = 1
            form.user_id = 1
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
