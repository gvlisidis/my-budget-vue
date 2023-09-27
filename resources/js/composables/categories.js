import {ref} from "vue";
import axios from "axios";

export function useCategories() {
    const categories = ref([]);
    const category = ref([]);
    const keywords = ref([]);

    const getCategories = async () => {
        await axios.get('/api/categories')
            .then((res) => {
                categories.value = res.data.data
            })
            .catch((error) => {
                console.log(error);
            })
    }
    const getCategory = async (id) => {
        await axios.get(`/api/categories/${id}/edit`)
            .then((response) => {
                category.value = response.data.data
                console.log(response.data)
            })
            .catch((error) => {
                console.log(error)
            })
    }

    const createKeyword = async (id, keyword) => {
        await axios.post(`/api/categories/${id}/keyword`, {
            keyword: keyword
        }).then((response) => {
            getCategory(id)
        })
            .catch((error) => {
                console.log(error)
            })
    }

    const destroyKeyword = async (id, keyword) => {
        await axios.delete(`/api/categories/${id}/keyword`, {data: {keyword: keyword}

        }).then((response) => {
            getCategory(id)
        })
            .catch((error) => {
                console.log(error)
            })
    }

    return {categories, category, getCategory, getCategories, createKeyword, destroyKeyword}
}
