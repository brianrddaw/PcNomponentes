<template>
    <section class="container">
        <img src="../../assets/logo-pcnomponentes.svg" alt="" />
        <div class="about-us">
            <h1>ABOUT US</h1>
            <div class="text-container">
                <p>PcNomponentes: Technology at your fingertips. Who are we?, PcNomponentes is your online technology store.</p>

                <p>
                    We offer a wide range of products at the best prices, with exceptional customer service. What do we offer?, At PcNomponentes, you will find everything you need
                    to equip your home, office, or business with the latest technology.
                </p>
                <p>
                    Why choose PcNomponentes?, Competitive prices, wide catalog of products, exceptional customer service, fast and secure shipping and satisfaction guarantee.
                    <br />
                    <br />
                    PcNomponentes: Your technological universe
                </p>
            </div>
        </div>
    </section>
</template>

<style scoped>
img {
    margin-top: auto;
    margin-bottom: auto;
    scale: 1;
}

.container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    max-width: 100vw;
    margin: auto;
    height: fit-content;
    max-height: 60vh;
    min-height: 60vh;
    padding: 1rem 10rem;
    text-align: justify;
    /* border-top: 1px solid #cccccc; */
    /* border-bottom: 1px solid #cccccc; */
    /* background-color: #f5f5f5; */
}
.about-us {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 3rem;
    /* border: 1px solid red; */
    padding: 2rem 0rem;
    padding-right: 0;
    height: 100%;
}

h1 {
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 3rem;
    height: fit-content;
    /* border: 1px solid blue; */
}

.text-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

p {
    display: flex;
    align-items: center;
    justify-content: center;
    height: fit-content;
    text-align: justify;
    max-width: 60%;
    /* border: 1px solid green; */
}
</style>
