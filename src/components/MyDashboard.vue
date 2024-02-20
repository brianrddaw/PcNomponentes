<template>
    <header>
        <img class="logo" src="../assets/logo-pcnomponentes.svg" alt="logo" @click="reloadPage" />

        <select class="products" id="dropdown" v-model="dropdown_product_selected">
            <option class="label" value="" disabled selected hidden>{{ dashboardLanguage[0][language]['products'] }}</option>
            <option value="Graphic card">{{ dashboardLanguage[0][language]['graphic-card'] }}</option>
            <option value="Monitor">{{ dashboardLanguage[0][language]['monitor'] }}</option>
            <option value="Keyboard">{{ dashboardLanguage[0][language]['keyboard'] }}</option>
            <option value="Laptop">{{ dashboardLanguage[0][language]['laptop'] }}</option>
            <option value="Tv">{{ dashboardLanguage[0][language]['tv'] }}</option>
        </select>

        <nav class="links">
            <p class="about-us-link" @click="toggleAboutUs">{{ dashboardLanguage[0][language]['about-us'] }}</p>

            <div class="user-logo-container" @click="toggleRegister">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" enable-background="new 0 0 24 24" class="user-icon">
                    <path
                        d="M12 12c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM20 20h-16v-1c0-3.5 3.3-6 8-6s8 2.5 8 6v1zm-13.8-2h11.7c-.6-1.8-2.8-3-5.8-3s-5.3 1.2-5.9 3z"
                    ></path>
                </svg>
                <p id="user-id">{{ dashboardLanguage[0][language]['my-user'] }}</p>
            </div>
            <p class="log-out" v-if="logStatus === 'true'" @click="logOut">{{ dashboardLanguage[0][language]['log-out'] }}</p>
            <div class="cart-logo-container" @click="toggleCart">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" enable-background="new 0 0 24 24" class="cart-icon">
                    <path
                        d="M2 2v2h3.2l2.8 12.2c.1.5.5.8 1 .8h10c.5 0 .9-.3 1-.8l2-8c.1-.3 0-.6-.2-.9-.2-.2-.5-.3-.8-.3h-.4l1.3-2.6c.2-.5.1-1-.3-1.3l-3-2c-.3-.1-.6-.1-.9-.1-.3.1-.5.3-.6.5l-2.1 4.3v-1.8c0-.6-.4-1-1-1h-4c-.6 0-1 .4-1 1v3h-1.1l-.9-4.2c-.1-.5-.5-.8-1-.8h-4zm11 3v2h-2v-2h2zm5.4 2h-1.8l1.8-3.5 1.3.9-1.3 2.6zm-10 2h11.3l-1.5 6h-8.4l-1.4-6z"
                    ></path>
                    <circle cx="18" cy="20" r="2"></circle>
                    <circle cx="10" cy="20" r="2"></circle>
                </svg>
                <p>{{ dashboardLanguage[0][language]['my-cart'] }}</p>
            </div>
            <div class="flag-container" @click="changeLanguage">
                <img src="../assets/english-flag.svg" alt="" v-if="language === 'english'" />
                <img src="../assets/spanish-flag.svg" alt="" v-else />
            </div>
        </nav>
    </header>
</template>

<script lang="ts" setup>
import { Ref, ref, defineEmits } from 'vue';
import $ from 'jquery';

let dropdown_product_selected: Ref = ref('');
let logStatus = localStorage.getItem('logStatus');

let language = localStorage.getItem('language');

let dashboardLanguage = [
    {
        spanish: {
            'about-us': 'Sobre nosotros',
            products: 'Productos',
            'my-user': 'Mi usuario',
            'log-out': 'Cerrar sesión',
            'my-cart': 'Carrito',
            'graphic-card': 'Gráfica',
            monitor: 'Monitor',
            keyboard: 'Teclado',
            laptop: 'Portátil',
            tv: 'TV',
        },

        english: {
            'about-us': 'About us',
            products: 'Products',
            'my-user': 'My user',
            'log-out': 'Log out',
            'my-cart': 'My cart',
            'graphic-card': 'Graphic card',
            monitor: 'Monitor',
            keyboard: 'Keyboard',
            laptop: 'Laptop',
            tv: 'TV',
        },
    },
];

// unLog user
function logOut() {
    logStatus = 'false';
    localStorage.setItem('logStatus', logStatus);
    window.location.reload();
}

// cambiar entre about us y productos
const emit = defineEmits(['toggle-register', 'log-out', 'toggle-about-us', 'toggle-cart']);
const toggleAboutUs = () => {
    emit('toggle-about-us', true);
};
// cambiar entre login y productos
const toggleRegister = () => {
    emit('toggle-register', true);
};

// cambiar entre login y productos
const toggleCart = () => {
    emit('toggle-cart', true);
};

function changeLanguage() {
    if (language === 'english') {
        localStorage.setItem('language', 'spanish');
    } else {
        localStorage.setItem('language', 'english');
    }
    window.location.reload();
}

$(document).ready(function () {
    $('#dropdown').on('change', function (event) {
        event.preventDefault();
        var product_id = dropdown_product_selected.value;

        $.ajax({
            url: 'http://localhost/pcnomponentes/database/GetProducts.php',
            type: 'GET',
            data: { product_id: product_id },
            success: function (response) {
                var data = JSON.parse(response);
                $('.product-title, .product-description, .product-price').css('display', 'none');
                switch (language) {
                    case 'english':
                        $('.product-title').text(data.title_en).fadeIn(700);
                        $('.product-description').text(data.description_en).fadeIn(700);

                        break;
                    case 'spanish':
                        $('.product-title').text(data.title).fadeIn(700);
                        $('.product-description').text(data.description).fadeIn(700);
                        break;
                }
                $('.product-price')
                    .text(data.price + ' €')
                    .fadeIn(700);
                $('.product_img').css('display', 'none');
                $('.product-img').attr('src', data.src).fadeIn(700);
            },
            error: function (error) {
                console.error('Error:', error);
            },
        });
    });
});
function reloadPage() {
    window.location.reload();
}
</script>

<style scoped>
header {
    display: grid;
    grid-template-columns: 0.4fr 0.6fr 0.8fr;
    align-items: center;
    border-bottom: 1px solid #cccccc;
    padding-left: 11.25rem;
    padding-right: 11.25rem;
    height: 9vh;
}

.logo {
    max-width: 8rem;
    cursor: pointer;
    /* border: 1px solid red; */
}

.products {
    width: 10rem;
    min-width: fit-content;
    padding: 0.7rem;
    border: 1px solid #cccccc;
    border-radius: 3px;
    background: url('../assets/arrow-down.png') no-repeat right #fff;
    background-size: 1rem;
    background-position: 85%;
    appearance: none;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
}

.products:hover {
    border-color: black;
    transition: all 0.2s ease-in-out;
}

.links {
    display: flex;
    justify-content: space-between;
    gap: 1rem;
    align-items: center;
    width: 100%;
    height: 100%;
    /* border: 1px solid green; */
}

.about-us-link,
.cart-logo-container,
.user-logo-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    cursor: pointer;
    width: fit-content;
    padding: 0.8rem 1rem;
    border-radius: 3px;
    transition: all 0.2s ease-in-out;
    /* border: 1px solid black; */
}

.about-us-link:hover,
.cart-logo-container:hover,
.user-logo-container:hover {
    background-color: #f5f5f5;
    transition: all 0.2s ease-in-out;
}

.log-out {
    cursor: pointer;
}

.log-out:hover {
    color: #0d74f3;
}

.user-icon,
.cart-icon {
    width: 1.5rem;
}

.flag-container img {
    width: 2rem;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
}
.flag-container img:hover {
    scale: 1.2;
    transition: all 0.2s ease-in-out;
}

@media screen and (max-width: 1800px) {
    header {
        padding-left: 2rem;
        padding-right: 2rem;
        grid-template-columns: 0.2fr 0.3fr 0.5fr;
        justify-items: center;
    }
}
</style>
