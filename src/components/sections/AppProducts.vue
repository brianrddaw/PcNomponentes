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
// Definir el tipo de objeto
type Product = {
    id: string;
    titulo: string;
    descripcion: string;
    precio: number;
};

// Crear un array de objetos
var productsArray: Product[] = [
    {
        id: 'grafica',
        titulo: 'Gigabyte GeForce RTX 4070 Windforce OC 12 GB GDDR6X DLSS3',
        descripcion:
            'Las GPU NVIDIA® GeForce RTX® serie 40 son más que rápidas para jugadores y creadores. Cuentan con la tecnología de la arquitectura ultra eficiente NVIDIA Ada Lovelace, que ofrece un salto espectacular tanto en rendimiento como en gráficos con tecnología de IA. Disfruta de mundos virtuales realistas con trazado de rayos y juegos con FPS ultra altos y la latencia más baja. Descubre nuevas y revolucionarias formas de crear contenido y una aceleración de flujo de trabajo sin precedentes',
        precio: 679.9,
    },
    {
        id: 'monitor',
        titulo: 'Asus TUF Gaming VG24VQR 23.6" LED FullHD 165Hz FreeSync Premium Curva',
        descripcion:
            'El TUF Gaming VG24VQR es un monitor curvo Full HD (1920 x 1080) de 23,6 pulgadas con 165 Hz* de refresco diseñado para gamers profesionales y usuarios que buscan una experiencia gráfica inmersiva. Su impresionante pantalla curva cuenta con Adaptive-Sync (FreeSync™ Premium), una tecnología que evita que ocurran problemas de sincronización de FPS.',
        precio: 225.0,
    },
];

// Obtener los productos por ID
function getProducts(productId: string): Product[] {
    return productsArray.filter((producto) => producto.id === productId);
}
</script>

<style scoped>
.container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 0.6fr 1fr 1fr;
    max-width: 97.5rem;
    margin: auto;
    height: fit-content;
    max-height: 50vh;
    min-height: 50vh;
    padding: 3rem;
    gap: 1rem;
    /* border: 1px solid black; */
    border-radius: 15px;
    /* background-color: #f5f5f5; */
    text-align: justify;
}

.product-img {
    border-radius: 15px;
    grid-row: span 3;
    height: 100%;
}

.product-title {
    font-size: 1.2rem;
    font-weight: 600;
}

.product-price {
    font-size: 1.2rem;
    margin-top: auto;
}
</style>
