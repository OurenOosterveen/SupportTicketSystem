<template>
    <form class="authbox" @submit.prevent>
        <h1>Wachtwoord vergeten</h1>

        <label for="email">E-mail</label>
        <FormError name="email" />
        <input id="email" v-model="email" type="email" name="email" />

        <div class="buttonbox">
            <button @click="submit">Verzenden</button>
            <RouterLink :to="{name: 'Login'}">Terug</RouterLink>
        </div>
    </form>
</template>
<script setup lang="ts">
import {postRequest} from 'services/http';
import {ref} from 'vue';
import {successToast} from 'services/toast';
import FormError from 'components/FormError.vue';

const email = ref('');

const submit = async () => {
    await postRequest('forgot-password', {email: email.value});
    successToast('Wachtwoord reset mail is verstuurd');
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
        margin-bottom: 1rem;
    }

    button {
        font-size: large;
        margin-top: 1rem;
        padding: 0.5rem;
        border-radius: 10px;
    }
</style>