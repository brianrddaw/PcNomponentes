<template>
    <div class="card">
        <img :src="props.src" alt="pic" />
        <p class="title-text">{{ props.title }}</p>
        <p class="price" v-if="props.price">{{ price * quantity !== 0 ? (price * quantity).toFixed(2) : 0 }} €</p>

        <div class="counter">
            <span class="decrement" @click="decrement">-</span>
            <span>{{ quantity }}</span>
            <span class="increment" @click="increment">+</span>
        </div>
        <img class="delete" src="../assets/x.svg" v-if="props.id" @click="deleteProductFromCart(props.id, $event)" />
    </div>
</template>

<script lang="ts" setup>
import $ from 'jquery';
import { Ref, ref, defineProps } from 'vue';

const props = defineProps({
    id: Number,
    title: String,
    price: Number,
    src: String,
    cantidad: Number,
});

let quantity: Ref<number> = ref(props.cantidad || 0);
let price: Ref<number> = ref(props.price || 0);

const userId = localStorage.getItem('userId');
const productId = props.id;

function decrement() {
    if (quantity.value <= 1) return;
    quantity.value--;
    $.ajax({
        url: 'http://localhost/pcnomponentes/database/incrementQuantity.php',
        type: 'POST',
        data: { productId: productId, quantity: quantity.value, userId: userId },
    });
}

function increment() {
    quantity.value++;
    $.ajax({
        url: 'http://localhost/pcnomponentes/database/incrementQuantity.php',
        type: 'POST',
        data: { productId: productId, quantity: quantity.value, userId: userId },
    });
}

// function updateTotalPrice() {
//     if (!props.price) return;
//     totalPrice.value = props.price * quantity.value;
//     $('#totalPrice').text(totalPrice.value.toFixed(2) + ' €');
// }
function deleteProductFromCart(productId: Number, event: any) {
    let userId = localStorage.getItem('userId');
    let $this = $(event.currentTarget);
    $.ajax({
        url: 'http://localhost/pcnomponentes/database/deleteProductFromCart.php',
        type: 'POST',
        data: { productId: productId, userId: userId },

        success: function (response) {
            console.log(response);
            $this.closest('.card').fadeOut(300);
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
    /* min-width: fit-content; */
    width: 30rem;
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

.title-text {
    max-width: 150px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

p {
    user-select: none;
}

.price {
    text-align: justify;
    min-width: 4.5rem;
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
    text-align: justify;
}

.delete {
    max-width: 0.8rem;
}

.delete:hover {
    filter: brightness(0) saturate(100%) invert(11%) sepia(97%) saturate(7497%) hue-rotate(4deg) brightness(98%) contrast(118%);
}

* {
    user-select: none;
}
</style>
