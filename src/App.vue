<template>
    <MyDashboard @toggle-register="toggleRegister" @toggle-about-us="toggleAboutUs" @toggle-cart="toggleCart" @toggle-products="toggleProducts" />
    <AppCarousel @toggle-products="toggleProducts" />
    <AppAboutUs v-if="appAboutUsState" />
    <AppProducts v-if="appProductsState" />
    <AppLogin v-if="appRegisterState" />
    <AppCarrito v-if="appCartState" />
    <AppFooter />
</template>

<script lang="ts" setup>
import AppCarrito from './components/sections/AppCarrito.vue';
import AppCarousel from './components/AppCarousel.vue';
import MyDashboard from './components/MyDashboard.vue';
import AppProducts from './components/sections/AppProducts.vue';
import AppLogin from './components/sections/AppLogin.vue';
import AppAboutUs from './components/sections/AppAboutUs.vue';
import AppFooter from './components/AppFooter.vue';
import { Ref, ref, onMounted } from 'vue';
import $ from 'jquery';

// languague
let languague = localStorage.getItem('language');
if (!languague) {
    localStorage.setItem('language', 'english');
}

// log status
let logStatus = localStorage.getItem('logStatus');
if (logStatus) {
    localStorage.setItem('logStatus', logStatus);
}

// The code snippet is a Vue.js lifecycle hook onMounted that executes when the component is mounted to the DOM. It checks if localStorage is available and if logStatus is 'true'. If both conditions are met, it attempts to retrieve the userLoged item from localStorage. If userLoged is found, it updates the text of the HTML element with the id user-id with the userToLog value, sets logStatus to 'true', and saves it to localStorage. If userLoged is not found, it sets the text of the user-id element to 'My user'.

onMounted(() => {
    if (localStorage && logStatus === 'true') {
        let userToLog = localStorage.getItem('userLoged');
        if (userToLog) {
            $('#user-id').text(userToLog);
            logStatus = 'true';
            localStorage.setItem('logStatus', logStatus);
        } else {
            $('#user-id').text('My user');
        }
    }
});

// states
let appProductsState: Ref<boolean> = ref(true);
let appRegisterState: Ref<boolean> = ref(false);
let appAboutUsState: Ref<boolean> = ref(false);
let appCartState: Ref<boolean> = ref(false);

// switch to products section
const toggleProducts = (newState: boolean) => {
    appProductsState.value = newState;
    appAboutUsState.value = !newState;
    appRegisterState.value = !newState;
    appCartState.value = !newState;
};

// switch to register
const toggleRegister = (newState: boolean) => {
    appRegisterState.value = newState;
    appProductsState.value = !newState;
    appAboutUsState.value = !newState;
    appCartState.value = !newState;
};

// switch to about us
const toggleAboutUs = (newState: boolean) => {
    appAboutUsState.value = newState;
    appRegisterState.value = !newState;
    appProductsState.value = !newState;
    appCartState.value = !newState;
};

// switch to cart
const toggleCart = (newState: boolean) => {
    if (localStorage && logStatus === 'false') {
        toggleRegister(newState);
    } else {
        appCartState.value = newState;
        appAboutUsState.value = !newState;
        appRegisterState.value = !newState;
        appProductsState.value = !newState;
    }
};
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
</style>
