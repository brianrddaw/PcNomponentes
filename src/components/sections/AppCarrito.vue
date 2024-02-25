<template>
    <section class="container">
        <div class="carrito">
            <div class="cards-container">
                <carritoCard
                    v-if="cartProducts.length > 0"
                    v-for="product in cartProducts"
                    :key="product.id"
                    :title="language === 'spanish' ? product.title : product.title_en"
                    :price="product.price"
                    :src="product.src"
                    :id="product.id_producto"
                    :cantidad="product.quantity"
                    @update-cart-price="updateCartPrice"
                />
                <p v-if="language === 'spanish' && cartProducts.length === 0">No hay productos en el carrito</p>
                <p v-else-if="language === 'english' && cartProducts.length === 0">There are no products in the cart</p>
            </div>
        </div>
        <div class="total">
            <div class="buy-container">
                <p>TOTAL</p>
                <p id="totalPrice">{{ totalPrice.toFixed(2) }} €</p>

                <button class="buy-button" @click.prevent="buyCart()" v-if="language === 'english'">Buy</button>
                <button class="buy-button" @click.prevent="buyCart()" v-else>Comprar</button>
            </div>
        </div>
    </section>
</template>

<script lang="ts" setup>
import $ from 'jquery';
import carritoCard from '../carritoCard.vue';
import { ref, Ref } from 'vue';

// language variable
let language = localStorage.getItem('language');

// user data that contains the dni of the loged user
let userId = localStorage.getItem('userId');

// cart data
let cartProducts: Ref = ref([]);

// total price
let totalPrice: Ref<number> = ref(0);

//This code defines a function called buyCart that sends a POST request to a specific URL using jQuery's $.ajax method. It sends the userId to the server and updates the cartProducts value when the request is successful. It also triggers an alert with the message 'Comprado' or 'Purchased' depending on the language.
function buyCart() {
    $.ajax({
        url: 'http://localhost/pcnomponentes/database/BuyCart.php',
        type: 'POST',
        data: { userId: userId },
        success: function (response) {
            cartProducts.value = [];
            if (language === 'english') {
                alert('Purchased');
            } else {
                alert('Comprado');
            }
        },
    });
}

// This code defines a function updateCartPrice that makes an AJAX POST request to a local URL to retrieve the user's cart data. Upon success, it updates the cartProducts and totalPrice values, and calculates the total price of the items in the cart. The setTimeout function is used to delay the AJAX request by 100 milliseconds.
function updateCartPrice() {
    setTimeout(() => {
        $.ajax({
            url: 'http://localhost/pcnomponentes/database/GetCart.php',
            type: 'POST',
            data: { userId: userId },

            success: function (response) {
                const data = JSON.parse(response);
                cartProducts.value = data;
                totalPrice.value = 0;

                for (let i = 0; i < data.length; i++) {
                    totalPrice.value += parseFloat(data[i].price) * data[i].quantity;
                }
            },
        });
    }, 30);
}

// This code calls the updateCartPrice function when the page is loaded.
$(document).ready(function () {
    updateCartPrice();
});
</script>

<style scoped>
.container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    justify-items: center;
    max-width: 100vw;
    margin: auto;
    max-height: 60vh;
    height: 60vh;
    padding: 0rem 15rem;
    text-align: justify;
}

.carrito {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    height: 100%;
    padding-top: 4rem;
}

.cards-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
    height: fit-content;
    max-height: 80%;
    width: calc(100% - 10rem);
    overflow-y: scroll;
}

.total {
    display: flex;
    justify-content: center;
    padding: 4rem;
    width: 80%;
    margin-right: auto;
}

.buy-container {
    display: flex;
    flex-direction: column;
    width: 60%;
    min-height: fit-content;
    height: 25rem;
    text-align: center;
    border: 1px solid #eeeeee;
    background-color: #fcfcfc;
    border-radius: 5px;
    padding-top: 3rem;
}

.buy-container p:first-child {
    font-weight: 600;
    margin-bottom: 4rem;
}
.buy-container p:nth-child(2) {
    border-bottom: 1px solid #0d74f3;
    width: fit-content;
    margin: auto;
    margin-bottom: 8rem;
}
.buy-container p {
    font-size: 1.5rem;
    font-variant-numeric: tabular-nums;
}

.buy-container hr {
    width: 60%;
    margin-left: auto;
    margin-right: auto;
}

.buy-button {
    margin: auto;
    margin-bottom: 3rem;
    width: 6rem;
    cursor: pointer;
    background-color: #0d74f3;
    border: 1px solid #0d74f3;
    padding: 0.5rem;
    border-radius: 5px;
    color: white;
    transition: all 0.2s ease-in-out;
}

.buy-button:hover {
    background-color: white;
    width: 7rem;
    color: #0d74f3;
    transition: all 0.2s ease-in-out;
}

.buy-button:active {
    scale: 0.98;
}
</style>
