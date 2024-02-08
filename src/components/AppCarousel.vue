<template>
    <section class="wrapper">
        <div class="carousel">
            <div class="card card-1"></div>
            <div class="card card-2"></div>
            <div class="card card-3"></div>
            <div class="card card-4"></div>
            <div class="card card-5"></div>
        </div>
    </section>
</template>

<script lang="ts" setup></script>
<style scoped>
.wrapper {
    width: 100%;
}

.carousel {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    max-width: 97.5rem;
    margin: auto;
    height: fit-content;
    padding: 1rem 0rem;
    gap: 1rem;
    /* border: 1px solid black; */
}

.card {
    width: 15rem;
    height: 15rem;
    border-radius: 10px;
    background-size: cover;
    transition: all 0.2s ease-in-out;
    cursor: pointer;
    /* border: 1px solid red; */
}

.card:hover {
    box-shadow: 0px 0px 10px 0px #cccccc;
    scale: 1.05;
    transition: all 0.2s ease-in-out;
}

.card-1 {
    background-image: url(../assets/carousel-img/home.webp);
}

.card-2 {
    background-image: url(../assets/carousel-img/laptop.webp);
}
.card-3 {
    background-image: url(../assets/carousel-img/monitor.webp);
}
.card-4 {
    background-image: url(../assets/carousel-img/other.webp);
}
.card-5 {
    background-image: url(../assets/carousel-img/tv.webp);
}
</style>
