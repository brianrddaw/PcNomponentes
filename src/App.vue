<template>
    <MyDashboard @toggle-register="toggleRegister" @toggle-about-us="toggleAboutUs" />
    <AppCarousel />
    <AppAboutUs v-if="appAboutUsState" />
    <AppProducts v-if="appProductsState" />
    <AppLogin v-if="appRegisterState" />
    <AppFooter />
</template>

<script lang="ts" setup>
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

let appRegisterState: Ref<boolean> = ref(false);
let appProductsState: Ref<boolean> = ref(true);
let appAboutUsState: Ref<boolean> = ref(false);

// cambiar de login a productos
const toggleRegister = (newState: boolean) => {
    appRegisterState.value = newState;
    appProductsState.value = !newState;
    appAboutUsState.value = !newState;
};

// cambiar de login a productos
const toggleAboutUs = (newState: boolean) => {
    appAboutUsState.value = newState;
    appRegisterState.value = !newState;
    appProductsState.value = !newState;
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
