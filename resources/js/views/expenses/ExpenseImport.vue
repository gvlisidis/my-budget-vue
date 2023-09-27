<template>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded h-fit p-10">
                <div class="mb-4 text-sm">
                    <div v-show="successMessage" class=" bg-green-200 opacity-75 rounded w-full py-2 px-4"><p class="text-gray-900">{{ successMessage }}</p></div>
                    <div v-show="errorMessage" class="bg-red-200 opacity-75 rounded w-full py-2 px-4"><p class="text-gray-900">{{ errorMessage }}</p></div>
                </div>
                <form @submit.prevent="handleSubmit" class="flex flex-col space-y-4" enctype="multipart/form-data">
                    <div>
                        <input type="file" ref="fileInput" name="monthly_expenses" @change="handleFileChange"
                               class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none"/>
                    </div>
                    <div class="flex">
                        <button class="font-medium bg-custom-500 hover:bg-custom-600 text-white py-2 px-4 rounded"
                                type="submit">Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import {ref} from "vue";
import axios from "axios";
import {useRouter} from "vue-router";

const router = useRouter();
const successMessage = ref('');
const errorMessage = ref('');

const file = ref(null)
const handleFileChange = (event) => {
    file.value = event.target.files[0]
}

const handleSubmit = async () => {
    const formData = new FormData()
    formData.append('file', file.value)
    await axios.post('/api/expenses/upload-file', formData)
        .then((response) => {
            // console.log(response)
            successMessage.value = response.data.message;

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
