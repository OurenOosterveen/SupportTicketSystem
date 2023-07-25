<template>
    <div class="authbox">
        <h1>Ticket systeem</h1>
        <label for="email">E-mail</label>
        <div v-if="getErrorBag.email" class="error">Een email is verplicht</div>
        <input id="email" v-model="credentials.email" type="email" name="email" />

        <label for="password">Wachtwoord</label>
        <div v-if="getErrorBag.password" class="error">Een wachtwoord is verplicht</div>
        <input id="password" v-model="credentials.password" type="password" name="password" />

        <div v-if="getErrorBag.credentials" class="error">{{ getErrorBag['credentials'] }} </div>
        <button @click="submit">Log in</button>
    </div>
</template>

<script setup lang="ts">
import {Credentials} from '../types';
import {getErrorBag} from 'services/error';
import {login} from '..';
import {ref} from 'vue';

const credentials = ref<Credentials>({
    email: '',
    password: '',
})

const errors = getErrorBag;

const submit = async () => {
    await login(credentials.value);
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