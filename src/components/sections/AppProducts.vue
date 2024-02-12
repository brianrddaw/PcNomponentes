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
        <div class="product-footer">
            <p class="product-price">{{ getProducts('grafica')[0].precio }} €</p>
            <button class="add-to-cart">Add to cart</button>
        </div>
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
    grid-template-rows: 1fr 1fr 1fr;
    max-width: 100vw;
    margin: auto;
    height: fit-content;
    max-height: 60vh;
    padding: 3rem 10rem;
    gap: 1rem;
    text-align: justify;
    /* background-color: #f5f5f5; */
}

.product-img {
    place-self: center;
    grid-row: span 3;
    margin-bottom: 1rem;
    scale: 1.5;
    max-height: 50%;
    transition: scale 0.2s ease-in-out;
}

.product-img:hover {
    scale: 1.6;
    transition: scale 0.2s ease-in-out;
}

.product-title {
    font-size: 1.2rem;
    font-weight: 600;
    max-width: 45rem;
    margin-top: 1rem;
}

.product-description {
    max-width: 45rem;
}
.product-price {
    font-size: 1.2rem;
}

.product-footer {
    display: flex;
    margin-top: auto;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.product-footer p {
    min-width: 5.375rem;
}

.product-footer button {
    margin-right: auto;
    cursor: pointer;
    background-color: #0d74f3;
    border: 1px solid #0d74f3;
    padding: 0.5rem;
    border-radius: 5px;
    color: white;
    transition: all 0.2s ease-in-out;
}

.product-footer button:hover {
    background-color: white;
    color: #0d74f3;
    transition: all 0.2s ease-in-out;
}

.product-footer button:active {
    scale: 0.98;
}
</style>
