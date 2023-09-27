<template>
    <nav class="overflow-hidden sticky top-0 h-screen min-h-full min-w-fit w-[200px] bg-custom-700 text-white block">
        <div class="flex flex-col justify-between h-full">
            <div class="flex flex-col">
                <router-link to="/" class="hover:bg-custom-500  py-2 px-4 border-b border-custom-50" active-class="bg-custom-500">Dashboard</router-link>
                <router-link to="/expenses" class="hover:bg-custom-500  py-2 px-4 border-b border-custom-50" active-class="bg-custom-500">Expenses</router-link>
                <router-link to="/categories" class="hover:bg-custom-500 py-2 px-4 border-b border-custom-50" active-class="bg-custom-500">Categories</router-link>
                <router-link to="/ideas" class="hover:bg-custom-500 py-2 px-4 border-b border-custom-50" active-class="bg-custom-500">New Ideas</router-link>
            </div>
            <button @click="handleLogout"
                    class="hover:bg-custom-500 py-2 px-4 hover:text-white border-t border-custom-50 text-left">
                Logout
            </button>
        </div>
    </nav>
</template>

<script setup>

const handleLogout = () => {
    axios.post('logout');
    location.reload();
}
</script>
