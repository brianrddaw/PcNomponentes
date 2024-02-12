<template>
    <footer>
        <p>© 2022 PcNomponentes. All rights reserved.</p>
        <p>C/ Blanca Rosa, 1</p>
        <p>pcnomponentes@pcnomponentes.com</p>
        <p>+34-699-999-999</p>
    </footer>
</template>

<script lang="ts" setup></script>

<style scoped>
footer {
    position: absolute;
    display: grid;
    bottom: 0;
    grid-template-columns: repeat(4, 1fr);
    justify-items: center;
    align-items: center;
    width: 100%;
    height: 5rem;
    background-color: #f5f5f5;
}
</style>
