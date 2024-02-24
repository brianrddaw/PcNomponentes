<template>
    <section class="container">
        <img class="product-img" src="../../assets/grafica.webp" alt="" />
        <div>
            <p class="product-title" v-if="productsArray.length > 0">{{ productsArray[0].title }}</p>
        </div>
        <div>
            <p class="product-description" v-if="productsArray.length > 0 && language === 'english'">{{ productsArray[0].description_en }}</p>
            <p class="product-description" v-else-if="productsArray.length > 0 && language === 'spanish'">{{ productsArray[0].description }}</p>
        </div>
        <div class="product-footer">
            <p class="product-price" v-if="productsArray.length > 0">{{ productsArray[0].price }} €</p>
            <button class="add-to-cart" @click="addProductToCart()">Add to cart</button>
        </div>
    </section>
</template>

<script lang="ts" setup>
import $ from 'jquery';
import { ref } from 'vue';

let language = localStorage.getItem('language');

interface Product {
    id: number;
    title: string;
    title_en: string;
    description: string;
    description_en: string;
    price: number;
}
const productsArray = ref<Product[]>([]);

$(document).ready(function () {
    $.ajax({
        url: 'http://localhost/pcnomponentes/database/GetAllProducts.php',
        type: 'GET',

        success: function (response) {
            const data = JSON.parse(response);
            for (var i = 0; i < data.length; i++) {
                productsArray.value.push(data[i]);
            }
        },

        error: function (error) {
            console.error('Error:', error);
        },
    });
});

function addProductToCart() {
    let product = $('.product-title').text();
    let userId = localStorage.getItem('userId');

    $.ajax({
        url: 'http://localhost/pcnomponentes/database/AddProductToCart.php',
        type: 'POST',
        data: { product: product, quantity: 1, userId: userId },

        success: function (response) {
            alert('Product added to cart');
        },
    });
}
</script>

<style scoped>
.container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr 1fr;
    max-width: 100vw;
    margin: auto;
    height: fit-content;
    max-height: 60vh;
    padding: 3rem 10rem;
    gap: 1rem;
    text-align: justify;
    /* background-color: #f5f5f5; */
}

.product-img {
    place-self: center;
    grid-row: span 3;
    margin-bottom: 1rem;
    scale: 1.5;
    max-height: 50%;
    transition: scale 0.2s ease-in-out;
}

.product-img:hover {
    scale: 1.6;
    transition: scale 0.2s ease-in-out;
}

.product-title {
    font-size: 1.2rem;
    font-weight: 600;
    max-width: 45rem;
    margin-top: 1rem;
}

.product-description {
    max-width: 45rem;
}
.product-price {
    font-size: 1.2rem;
}

.product-footer {
    display: flex;
    margin-top: auto;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.product-footer p {
    min-width: 5.375rem;
}

.product-footer button {
    margin-right: auto;
    cursor: pointer;
    background-color: #0d74f3;
    border: 1px solid #0d74f3;
    padding: 0.5rem;
    border-radius: 5px;
    color: white;
    transition: all 0.2s ease-in-out;
}

.product-footer button:hover {
    background-color: white;
    color: #0d74f3;
    transition: all 0.2s ease-in-out;
}

.product-footer button:active {
    scale: 0.98;
}
</style>
