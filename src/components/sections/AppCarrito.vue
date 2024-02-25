<template>
    <section class="container">
        <div class="carrito">
            <div class="cards-container">
                <carritoCard
                    v-for="product in cartProducts"
                    :key="product.id"
                    :title="language === 'spanish' ? product.title : product.title_en"
                    :price="product.price"
                    :src="product.src"
                    :id="product.id_producto"
                />
            </div>
        </div>
        <div class="total">
            <h1>aqui va el total</h1>
        </div>
    </section>
</template>

<script lang="ts" setup>
import $ from 'jquery';
import carritoCard from '../carritoCard.vue';
import { ref, Ref } from 'vue';

let cartProducts: Ref = ref([]);
let language = localStorage.getItem('language');

$(document).ready(function () {
    let userId = localStorage.getItem('userId');
    $.ajax({
        url: 'http://localhost/pcnomponentes/database/GetCart.php',
        type: 'POST',
        data: { userId: userId },

        success: function (response) {
            const data = JSON.parse(response);
            cartProducts.value = data;

            for (var i = 0; i < cartProducts.value.length; i++) {
                console.log(cartProducts.value[i]);
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
    /* border: 1px solid blue; */
    width: 100%;
}

/* ::-webkit-scrollbar {
    display: none;
} */
</style>
