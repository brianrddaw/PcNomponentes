<template>
    <section class="wrapper">
        <div class="carousel">
            <img
                v-for="product in products"
                :key="product.id"
                class="card"
                :src="product.src"
                alt="v-text: product.name"
                :value="product.name"
                @click="getImgValue(product.name)"
            />
        </div>
        <div class="carousel">
            <img
                v-for="product in products"
                :key="product.id"
                class="card"
                :src="product.src"
                alt="v-text: product.name"
                :value="product.name"
                @click="getImgValue(product.name)"
            />
        </div>
    </section>
</template>

<script lang="ts" setup>
import $ from 'jquery';
import { Ref, ref, defineEmits } from 'vue';

let products: Ref = ref([]);
let language = localStorage.getItem('language');

// switch to products section logic
const emit = defineEmits(['toggle-products']);
const toggleProducts = () => {
    emit('toggle-products', true);
};

// This code defines a function getImgValue that makes an asynchronous AJAX request to fetch product data and then updates the UI with the received data. It also uses a timer to delay the AJAX request by 30 milliseconds.
function getImgValue(productName: string) {
    var product_id = productName;
    toggleProducts();

    setTimeout(() => {
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
    }, 30);
}
$(document).ready(function () {
    $.ajax({
        url: 'http://localhost/pcnomponentes/database/GetAllProducts.php',
        type: 'GET',

        success: function (response) {
            const data = JSON.parse(response);

            // Append new products to the existing array
            for (var i = 0; i < data.length; i++) {
                products.value.push(data[i]);
            }
        },

        error: function (error) {
            console.error('Error:', error);
        },
    });
});
</script>
<style scoped>
.wrapper {
    position: relative;
    overflow: hidden;
    padding: 1rem 0;
    background: white;
    white-space: nowrap;
    border-bottom: 1px solid #cccccc;
    max-height: 21vh;
    height: 21vh;
}

.carousel {
    display: inline-block;
    animation: carouselLoop 35s linear infinite;
}

.card {
    border-radius: 15px;
    height: 10rem;
    background-size: cover;
    margin-right: 15rem;
}

.card:hover {
    cursor: pointer;
    scale: 1.1;
    transition: all 0.2s ease-in-out;
}

.wrapper:hover > .carousel {
    animation-play-state: paused;
}

.wrapper::before,
.wrapper::after {
    position: absolute;
    top: 0;
    width: 10rem;
    height: 100%;
    z-index: 2;
    content: '';
}
.wrapper::before {
    left: 0;
    background: linear-gradient(to left, rgba(255, 255, 255, 0), white);
}
.wrapper::after {
    right: 0;
    background: linear-gradient(to left, white, rgba(255, 255, 255, 0));
}

@keyframes carouselLoop {
    from {
        transform: translateX(0);
    }

    to {
        transform: translateX(-100%);
    }
}
</style>
