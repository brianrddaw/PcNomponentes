<template>
    <div class="card">
        <img :src="props.src" alt="pic" />
        <p class="title-text">{{ props.title }}</p>
        <p class="price" v-if="props.price">{{ price * quantity !== 0 ? (price * quantity).toFixed(2) : 0 }} €</p>

        <div class="counter">
            <span class="decrement" @click="decrement"><img src="../assets/minus.svg" alt="-" /></span>
            <span>{{ quantity }}</span>
            <span class="increment" @click="increment"><img src="../assets/plus.svg" alt="+" /></span>
        </div>
        <img class="delete" src="../assets/x.svg" v-if="props.id" @click="deleteProductFromCart(props.id, $event)" />
    </div>
</template>

<script lang="ts" setup>
import $ from 'jquery';
import { Ref, ref, defineProps, defineEmits } from 'vue';

// update cart emit function
const emit = defineEmits(['update-cart-price']);

// This code snippet defines a function called updateCartPrice in a Vue component. When called, it emits an event named 'update-cart-price'.
const updateCartPrice = () => {
    emit('update-cart-price');
};

// props definition
const props = defineProps({
    id: Number,
    title: String,
    price: Number,
    src: String,
    cantidad: Number,
});

// quantity and price variables
let quantity: Ref<number> = ref(props.cantidad || 0);
let price: Ref<number> = ref(props.price || 0);

// userId and productId variables
const userId = localStorage.getItem('userId');
const productId = props.id;

// This code defines a function called "decrement" which decreases the quantity value by 1 and makes an AJAX POST request to update the quantity in the database. It also calls the "updateCartPrice" function.
function decrement() {
    if (quantity.value <= 1) return;
    quantity.value--;
    $.ajax({
        url: 'http://localhost/pcnomponentes/database/incrementQuantity.php',
        type: 'POST',
        data: { productId: productId, quantity: quantity.value, userId: userId },
    });
    updateCartPrice();
}

// This code defines a function called increment which increases the value of quantity, makes an AJAX request to increment the quantity in the database, and then calls updateCartPrice.

function increment() {
    quantity.value++;
    $.ajax({
        url: 'http://localhost/pcnomponentes/database/incrementQuantity.php',
        type: 'POST',
        data: { productId: productId, quantity: quantity.value, userId: userId },
    });
    updateCartPrice();
}

// This code defines a function called deleteProductFromCart in a Vue component. It makes an AJAX request to a local server to delete a product from the user's cart using the product ID and the user ID retrieved from the local storage. Upon success, it fades out the product card and updates the cart price. If there's an error, it logs the error to the console.

function deleteProductFromCart(productId: Number, event: any) {
    let userId = localStorage.getItem('userId');
    let $this = $(event.currentTarget);
    $.ajax({
        url: 'http://localhost/pcnomponentes/database/deleteProductFromCart.php',
        type: 'POST',
        data: { productId: productId, userId: userId },

        success: function (response) {
            $this.closest('.card').fadeOut(300);
            updateCartPrice();
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
    font-variant-numeric: tabular-nums;
}

.counter {
    display: flex;
    justify-content: space-around;
    width: 5rem;
    margin: auto;
}

.decrement,
.increment {
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.decrement img,
.increment img {
    width: 1rem;
}
.decrement img:hover,
.increment img:hover {
    filter: brightness(0) saturate(100%) invert(31%) sepia(100%) saturate(3988%) hue-rotate(141deg) brightness(95%) contrast(103%);
}
.decrement img:active,
.increment img:active {
    scale: 0.9;
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
