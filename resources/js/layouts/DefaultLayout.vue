<template>
    <div class="flex flex-row relative ">
        <Navbar/>
        <div class="flex-1 relative pb-10">
            <router-view></router-view>
        </div>
    </div>
</template>

<script setup>

import Navbar from "./Navbar.vue";
</script>
