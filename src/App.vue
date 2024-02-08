<template>
    <MyDashboard />
    <AppCarousel />
    <AppProducts />
</template>

<script lang="ts" setup>
import AppCarousel from './components/AppCarousel.vue';
import MyDashboard from './components/MyDashboard.vue';
import AppProducts from './components/sections/AppProducts.vue';
</script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    min-width: 0;
    font-family: 'Open Sans', sans-serif;
    line-height: 1.5rem;
    font-weight: 400;
    font-size: 1rem;
    color: #333333;
}

/* h2 {
    text-align: center;
    margin: 0 auto;
    margin-top: 2rem;
    margin-bottom: calc(1.5rem - 16px);
    font-size: 1.125rem;
    font-weight: 600;
} */
</style>
