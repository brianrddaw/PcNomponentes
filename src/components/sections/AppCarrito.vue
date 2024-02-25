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
                />
                <p v-else>No hay productos en el carrito</p>
            </div>
        </div>
        <div class="total">
            <div class="buy-container">
                <p>TOTAL</p>
                <p id="totalPrice">{{ totalPrice.toFixed(2) }}</p>
            </div>
        </div>
    </section>
</template>

<script lang="ts" setup>
import $ from 'jquery';
import carritoCard from '../carritoCard.vue';
import { ref, Ref } from 'vue';

let language = localStorage.getItem('language');
let cartProducts: Ref = ref([]);
let totalPrice: Ref<number> = ref(0);

$(document).ready(function () {
    let userId = localStorage.getItem('userId');
    $.ajax({
        url: 'http://localhost/pcnomponentes/database/GetCart.php',
        type: 'POST',
        data: { userId: userId },

        success: function (response) {
            const data = JSON.parse(response);
            cartProducts.value = data;

            for (let i = 0; i < data.length; i++) {
                totalPrice.value += parseFloat(data[i].price) * data[i].quantity;
            }
        },
    });
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
    /* border: 1px solid black; */
    /* background-color: #f5f5f5; */
}

.carrito {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    height: 100%;
    padding-top: 4rem;
    border: 1px solid red;
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
    /* border: 1px solid green; */
}

.total {
    display: flex;
    justify-content: center;
    border: 1px solid blue;
    padding: 4rem;
    width: 100%;
}

/* ::-webkit-scrollbar {
    display: none;
} */
</style>
