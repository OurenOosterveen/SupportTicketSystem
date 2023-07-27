<template>
    <div class="authbox">
        <h1>Ticket systeem</h1>
        <label for="email">E-mail</label>
        <FormError name="email" />
        <input id="email" v-model="credentials.email" type="email" name="email" />

        <label for="password">Wachtwoord</label>
        <FormError name="password" />
        <input id="password" v-model="credentials.password" type="password" name="password" />

        <FormError name="credentials" />
        <button @click="submit">Log in</button>

        <RouterLink :to="{name: 'forgotPassword'}" style="font-size: small; align-self: center;">
            Wachtwoord vergeten?
        </RouterLink>
    </div>
</template>

<script setup lang="ts">
import {Credentials} from '../types';
import {RouterLink} from 'vue-router';
import {TICKET_DOMAIN_NAME} from 'domains/tickets';
import {goToOverviewPage} from 'services/router';
import {login} from '..';
import {ref} from 'vue';
import FormError from 'components/FormError.vue'

const credentials = ref<Credentials>({
    email: '',
    password: '',
});

const submit = async () => {
    await login(credentials.value);
    goToOverviewPage(TICKET_DOMAIN_NAME);
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
        margin-bottom: 1rem;
    }

    button {
        font-size: large;
        margin-top: 1rem;
        padding: 0.5rem;
        border-radius: 10px;
        width: 100%;
    }
</style>