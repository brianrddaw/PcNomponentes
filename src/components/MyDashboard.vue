<template>
    <header>
        <img class="logo" src="../assets/logo-pcnomponentes.svg" alt="logo" @click="reloadPage" />

        <select class="products" id="dropdown" v-model="dropdown_product_selected">
            <option class="label" value="" disabled selected hidden>Products</option>
            <option value="Graphic card">Graphic card</option>
            <option value="Monitor">Monitor</option>
            <option value="Keyboard">Keyboard</option>
            <option value="Laptop">Laptop</option>
            <option value="Tv">Tv</option>
        </select>

        <nav class="links">
            <p class="about-us-link" @click="toggleAboutUs">About us</p>

            <div class="user-logo-container" @click="toggleRegister">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" enable-background="new 0 0 24 24" class="user-icon">
                    <path
                        d="M12 12c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM20 20h-16v-1c0-3.5 3.3-6 8-6s8 2.5 8 6v1zm-13.8-2h11.7c-.6-1.8-2.8-3-5.8-3s-5.3 1.2-5.9 3z"
                    ></path>
                </svg>
                <p id="user-id">My user</p>
            </div>
            <p class="log-out" v-if="logStatus === 'true'" @click="logOut">Log out</p>
            <div class="cart-logo-container">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" enable-background="new 0 0 24 24" class="cart-icon">
                    <path
                        d="M2 2v2h3.2l2.8 12.2c.1.5.5.8 1 .8h10c.5 0 .9-.3 1-.8l2-8c.1-.3 0-.6-.2-.9-.2-.2-.5-.3-.8-.3h-.4l1.3-2.6c.2-.5.1-1-.3-1.3l-3-2c-.3-.1-.6-.1-.9-.1-.3.1-.5.3-.6.5l-2.1 4.3v-1.8c0-.6-.4-1-1-1h-4c-.6 0-1 .4-1 1v3h-1.1l-.9-4.2c-.1-.5-.5-.8-1-.8h-4zm11 3v2h-2v-2h2zm5.4 2h-1.8l1.8-3.5 1.3.9-1.3 2.6zm-10 2h11.3l-1.5 6h-8.4l-1.4-6z"
                    ></path>
                    <circle cx="18" cy="20" r="2"></circle>
                    <circle cx="10" cy="20" r="2"></circle>
                </svg>
                <p>My cart</p>
            </div>
        </nav>
    </header>
</template>

<script lang="ts" setup>
import { Ref, ref, defineEmits } from 'vue';
import $ from 'jquery';

let dropdown_product_selected: Ref = ref('');
let logStatus = localStorage.getItem('logStatus');

// unLog user
function logOut() {
    logStatus = 'false';
    localStorage.setItem('logStatus', logStatus);
    window.location.reload();
}

// cambiar entre about us y productos
const emit = defineEmits(['toggle-register', 'log-out', 'toggle-about-us']);
const toggleAboutUs = () => {
    alert('pepe');
    emit('toggle-about-us', true);
};
// cambiar entre login y productos
const toggleRegister = () => {
    alert('toggleRegister called');
    emit('toggle-register', true);
};

$(document).ready(function () {
    $('#dropdown').on('change', function (event) {
        event.preventDefault();
        var product_id = dropdown_product_selected.value;

        $.ajax({
            url: 'http://localhost/GetProducts.php',
            type: 'GET',
            data: { product_id: product_id },
            success: function (response) {
                var data = JSON.parse(response);
                $('.product-title, .product-description, .product-price').css('display', 'none');
                $('.product-title').text(data.title).fadeIn(700);
                $('.product-description').text(data.description).fadeIn(700);
                $('.product-price')
                    .text(data.price + ' €')
                    .fadeIn(700);
                console.log(data.src);
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
    grid-template-columns: 0.6fr 0.8fr 0.7fr;
    align-items: center;
    border-bottom: 1px solid #cccccc;
    padding-left: 11.25rem;
    padding-right: 11.25rem;
    height: 5.0625rem;
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
    width: 8.125rem;
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

@media screen and (max-width: 1800px) {
    header {
        padding-left: 2rem;
        padding-right: 2rem;
        grid-template-columns: 0.2fr 0.3fr 0.5fr;
        justify-items: center;
    }
}
</style>
