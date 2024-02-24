<template>
    <section class="container">
        <div class="carrito">
            <carritoCard v-for="product in cartProducts" :key="product.id" :title="product.title" :price="product.price" :src="product.src" :id="product.id_producto" />
        </div>
    </section>
</template>

<script lang="ts" setup>
import $ from 'jquery';
import carritoCard from '../carritoCard.vue';
import { ref, Ref } from 'vue';

let cartProducts: Ref = ref([]);

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
    display: flex;
    justify-content: center;
    max-width: 100vw;
    margin: auto;
    height: fit-content;
    max-height: 60vh;
    height: 60vh;
    padding: 0rem 10rem;
    text-align: justify;
    border: 1px solid black;
    /* background-color: #f5f5f5; */
}

.carrito {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    padding: 5rem;
    width: 65vw;
    height: 100%;
    border: 1px solid red;
}
</style>
