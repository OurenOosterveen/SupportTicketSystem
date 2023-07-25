<template>
    <div class="authbox">
        <h1>Wachtwoord vergeten</h1>

        <label for="email">E-mail</label>
        <div v-if="getErrorBag['email']" class="error">Email veld required</div>
        <input id="email" v-model="email" type="email" name="email" />

        <div class="buttonbox">
            <button @click="submit">Verzenden</button>
            <RouterLink :to="{name: 'Login'}">Terug</RouterLink>
        </div>
    </div>
</template>
<script setup lang="ts">
import {getErrorBag} from 'services/error';
import {postRequest} from 'services/http';
import {ref} from 'vue';

const email = ref('');

const submit = async () => {
    await postRequest('forgotPassword', {email: email.value});
}
</script>

<style>
    .authbox {
        display: flex;
        flex-direction: column;
        margin: 3rem;
        padding: 1.5rem 3rem;
        background-color: ghostwhite;
        border-radius: 25px;
        max-width: 50%;
    }

    .buttonbox {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    input {
        border: 1px solid grey;
    }

    input {
        margin-bottom: 1rem;
    }

    button {
        font-size: large;
        margin-top: 1rem;
        padding: 0.5rem;
        border-radius: 10px;
    }

    .error {
        color: red;
        font-size: small;
    }
</style>