<template>
    <footer>
        <p>© 2024 PcNomponentes. All rights reserved.</p>
        <p>C/ Blanca Rosa, 1</p>
        <p>pcnomponentes@pcnomponentes.com</p>
        <p>+34-699-999-999</p>
    </footer>
</template>

<script lang="ts" setup></script>

<style scoped>
footer {
    display: flex;
    justify-content: space-around;
    bottom: 0;
    justify-items: center;
    align-items: center;
    width: 100%;
    height: 10vh;
    border-top: 1px solid #cccccc;
}

footer p {
    font-size: 1.1rem;
}
</style>
