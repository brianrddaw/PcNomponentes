<template>
    <div class="card">
        <img :src="props.src" alt="pic" />
        <p class="title-text">{{ props.title }}</p>
        <p v-if="props.price">{{ props.price * quantity !== 0 ? (props.price * quantity).toFixed(2) : 0 }} €</p>

        <div class="counter">
            <span class="decrement" @click="decrement">-</span>
            <span>{{ quantity }}</span>
            <span class="increment" @click="increment">+</span>
        </div>
        <img class="delete" src="../assets/x.svg" v-if="props.id" @click="deleteProductFromCart(props.id)" />
    </div>
</template>

<script lang="ts" setup>
import $ from 'jquery';
import { ref } from 'vue';
import { defineProps } from 'vue';

const props = defineProps({
    id: Number,
    title: String,
    price: Number,
    src: String,
    cantidad: Number,
});

let quantity = ref(1);

function decrement() {
    if (quantity.value > 0) {
        quantity.value--;
    }
}

function increment() {
    quantity.value++;
}

function deleteProductFromCart(productId: any) {
    let userId = localStorage.getItem('userId');
    alert(productId);
    $.ajax({
        url: 'http://localhost/pcnomponentes/database/deleteProductFromCart.php',
        type: 'POST',
        data: { productId: productId, userId: userId },

        success: function (response) {
            console.log(response);
        },
        error: function (error) {
            console.error('Error:', error);
        },
    });
}
</script>

<style scoped>
.card {
    display: flex;
    align-items: center;
    min-width: fit-content;
    width: fit-content;
    gap: 1rem;
    padding: 1rem;
    background-color: #fcfcfc;
    border-radius: 8px;
    border: 1px solid #eeeeee;
    cursor: pointer;
}

.card img {
    width: 3rem;
}

.title-text {
    width: 565px;
}

.card p {
    max-width: 300px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

p {
    user-select: none;
}

.counter {
    display: flex;
    justify-content: space-around;
    width: 5rem;
    margin: auto;
    /* border: 1px solid red; */
}

.decrement,
.increment {
    cursor: pointer;
}

.delete {
    max-width: 0.8rem;
}

* {
    user-select: none;
}
</style>
