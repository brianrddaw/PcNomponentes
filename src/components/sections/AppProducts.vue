<template>
    <section class="container">
        <img class="product-img" src="../../assets/grafica.webp" alt="" />
        <div>
            <p class="product-title">{{ getProducts('grafica')[0].titulo }}</p>
        </div>
        <div>
            <p class="product-description">
                {{ getProducts('grafica')[0].descripcion }}
            </p>
        </div>
        <p class="product-price">{{ getProducts('grafica')[0].precio }} €</p>
    </section>
</template>

<script lang="ts" setup>
type Product = {
    id: string;
    titulo: string;
    descripcion: string;
    precio: number;
};

var productsArray: Product[] = [
    {
        id: 'grafica',
        titulo: 'Gigabyte GeForce RTX 4070 Windforce OC 12 GB GDDR6X DLSS3',
        descripcion:
            'Las GPU NVIDIA® GeForce RTX® serie 40 son más que rápidas para jugadores y creadores. Cuentan con la tecnología de la arquitectura ultra eficiente NVIDIA Ada Lovelace, que ofrece un salto espectacular tanto en rendimiento como en gráficos con tecnología de IA. Disfruta de mundos virtuales realistas con trazado de rayos y juegos con FPS ultra altos y la latencia más baja. Descubre nuevas y revolucionarias formas de crear contenido y una aceleración de flujo de trabajo sin precedentes',
        precio: 679.9,
    },
];

function getProducts(productId: string): Product[] {
    return productsArray.filter((producto) => producto.id === productId);
}
</script>

<style scoped>
.container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 0.6fr 1fr 1fr;
    align-items: center;
    max-width: 97.5rem;
    margin: auto;
    height: fit-content;
    max-height: 50vh;
    min-height: 58vh;
    padding: 2rem;
    gap: 1rem;
    /* border: 1px solid black; */
    border-radius: 15px;
    /* background-color: #f5f5f5; */
    text-align: justify;
}

.product-img {
    place-self: center;
    scale: 1.2;
    grid-row: span 3;
    margin-bottom: 4rem;
    height: 70%;
    transition: scale 0.2s ease-in-out;
}

.product-img:hover {
    scale: 1.2;
    transition: scale 0.2s ease-in-out;
}

.product-title {
    font-size: 1.2rem;
    font-weight: 600;
}

.product-price {
    font-size: 1.2rem;
}
</style>
