<template>
    <div class="authbox">
        <h1>Nieuw wachtwoord instellen</h1>

        <label for="password">Wachtwoord</label>
        <div v-if="getErrorBag['password']" class="error">Wachtwoord is verplicht</div>
        <input id="password" v-model="credentials.password" type="password" name="password" />

        <label for="password_confirmation">Wachtwoord opnieuw</label>
        <div v-if="getErrorBag['password_confirmation']" class="error">Wachtwoord is verplicht</div>
        <input 
            id="password_confirmation"
            v-model="credentials.password_confirmation" 
            type="password" 
            name="password_confirmation" 
        />

        <div class="buttonbox">
            <button @click="submit">Verzenden</button>
            <RouterLink :to="{name: 'Login'}">Terug</RouterLink>
        </div>
    </div>
</template>
<script setup lang="ts">
import {getErrorBag} from 'services/error';
import {goToLoginPage} from '..';
import {postRequest} from 'services/http';
import {ref} from 'vue';
import {successToast} from 'services/toast';
import {useRoute} from 'vue-router';

const route = useRoute();
const credentials = ref({
    email: route.query.email,
    token: route.query.token,
    password: '',
    password_confirmation: '',
});

const submit = async () => {
    await postRequest('reset-password', credentials.value);
    successToast('Wachtwoord is gereset.')
    goToLoginPage();
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