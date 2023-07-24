<template>
    <div class="authbox">
        <label for="email">E-mail</label>
        <input id="email" v-model="credentials.email" type="email" name="email" />

        <label for="password">Wachtwoord</label>
        <input id="password" v-model="credentials.password" type="password" name="password" />

        <button @click="submit">Log in</button>
    </div>
</template>

<script setup lang="ts">
import { login } from '..';
import {Credentials} from '../types';
import {ref} from 'vue';

const credentials = ref<Credentials>({
    email: '',
    password: '',
})

const submit = () => {
    login(credentials.value)
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

    input {
        border: 1px solid grey;
    }

    label {
        margin-top: 1rem;
    }

    button {
        margin-top: 1rem;
    }
</style>