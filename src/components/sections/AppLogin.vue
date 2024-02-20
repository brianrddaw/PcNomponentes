<template>
    <section class="container">
        <form action="" v-if="!register" @submit.prevent="logUser">
            <h1>LOGIN</h1>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" v-model="userEmail" />

            <label for="password">Password</label>
            <input type="password" name="password" id="password" v-model="userPassword" />
            <div class="submit-container">
                <p @click="toggleRegister">Not registered yet?</p>

                <input type="submit" class="submit" value="Login" />
            </div>
        </form>
        <!-- Name, Id, e-mail, bank account , phone number -->
        <form class="register-form" action="http://localhost/RegisterUser.php" method="post" @submit.prevent="registerUser" v-else>
            <h1>REGISTER</h1>
            <label for="id">Id (NIF, DNI, etc)</label>
            <input type="id" name="id" id="user-id" v-model="userId" />

            <label for="email">Email</label>
            <input type="email" name="email" id="email" v-model="userEmail" />

            <label for="username">Name</label>
            <input type="text" name="username" id="username" v-model="userName" />

            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" v-model="userPhone" />

            <label for="bankAccount">Bank Account</label>
            <input type="text" name="bankAccount" id="bankAccount" v-model="userBankAccount" />

            <label for="password">Password</label>
            <input type="password" name="password" id="password" v-model="userPassword" />
            <div class="submit-container">
                <p @click="toggleRegister">Already registered?</p>
                <input type="submit" class="submit" value="Register" />
            </div>
        </form>
    </section>
</template>

<script lang="ts" setup>
import { ref, Ref } from 'vue';
import $ from 'jquery';

let register: Ref<boolean> = ref(false);

// cambiar entre login y register
function toggleRegister() {
    register.value = !register.value;
}

let userName: Ref<string> = ref('');
let userEmail: Ref<string> = ref('');
let userPassword: Ref<string> = ref('');
let userId: Ref<string> = ref('');
let userPhone: Ref<string> = ref('');
let userBankAccount: Ref<string> = ref('');

// registrar usuario mediante ajax
function registerUser() {
    $.ajax({
        url: 'http://localhost/RegisterUser.php',
        type: 'POST',
        data: {
            userName: userName.value,
            userEmail: userEmail.value,
            userPassword: userPassword.value,
            userPhone: userPhone.value,
            userBankAccount: userBankAccount.value,
            userId: userId.value,
        },
        success: function (response) {
            // Handle successful response
            alert('Usuario creado');
            console.log(response);
        },
        error: function (error) {
            // Handle error
            console.error('Error:', error);
        },
    });
}

// loguearse
function logUser() {
    $.ajax({
        url: 'http://localhost/pcnomponentes/database/LogUser.php',
        type: 'POST',
        data: {
            userEmail: userEmail.value,
            userPassword: userPassword.value,
        },
        success: function (response) {
            // Handle successful response
            let data = JSON.parse(response);
            let dataName = data.name;
            localStorage.setItem('userLoged', dataName);
            localStorage.setItem('logStatus', 'true');
            console.log(localStorage.getItem('logStatus'));
            $('#user-id').text(dataName);
            window.location.reload();
        },
        error: function (error) {
            // Handle error
            console.error('Error:', error);
        },
    });
}
</script>

<style scoped>
.container {
    display: grid;
    max-width: 97.5rem;
    margin: auto;
    height: fit-content;
    max-height: 60vh;
    min-height: 60vh;
    padding: 2rem;
    gap: 1rem;
    border-radius: 15px;
    text-align: justify;
    /* background-color: #f5f5f5; */
    /* border: 1px solid black; */
}

h1 {
    font-size: 1.5rem;
    text-align: center;
    font-weight: 600;
    margin-bottom: 1.5rem;
}
.container form {
    display: flex;
    flex-direction: column;
    margin: auto;
    width: 30%;
    height: 100%;
    min-width: fit-content;
    padding: 0rem 2.5rem;
    gap: 1rem;
    border-radius: 8px;
    /* border: 1px solid #cccccc; */
}

form input {
    padding: 0.4rem;
    padding-left: 1rem;
    border-radius: 0.3rem;
    border: 0px solid transparent;
    background-color: #f5f5f5;
}

form input:focus {
    outline: none;
    /* border: 1px solid #0d74f3;
    background-color: white; */
}

.container .register-form {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(8, 1fr);
    align-items: center;
    gap: 0.5rem;
    width: fit-content;
    height: fit-content;
    /* border: 1px solid red; */
}
.container .register-form h1 {
    grid-column: span 2;
}

.container .register-form input {
    max-height: 80%;
    width: 300px;
    border: 1px solid transparent;
}

.container .register-form input:hover,
.container .register-form input:focus {
    border: 1px solid #0d74f3;
}

.submit-container {
    display: flex;
    align-items: end;
    margin-top: auto;
    justify-content: space-between;
    grid-column: span 2;
    /* border: 1px solid red; */
}

.submit-container p {
    cursor: pointer;
}
.submit-container p:hover {
    color: #0d74f3;
}

.submit {
    cursor: pointer;
    padding: 0.8rem 1.5rem;
    max-width: fit-content;
    width: fit-content;
    max-height: fit-content;
    border: 0px solid transparent;
    border-radius: 0.3rem;
    background-color: #0d74f3;
    color: white;
    transition: all 0.2s ease-in-out;
}

.submit:hover {
    background-color: #0b5cbf;
    transition: all 0.2s ease-in-out;
}
</style>
