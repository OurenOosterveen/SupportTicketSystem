<template>
    <form class="authbox" @submit.prevent>
        <h1>Nieuw wachtwoord instellen</h1>

        <label for="password">Wachtwoord</label>
        <FormError name="password" />
        <input id="password" v-model="credentials.password" type="password" name="password" />

        <label for="password_confirmation">Wachtwoord opnieuw</label>
        <FormError name="password_confirmation" />
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
    </form>
</template>
<script setup lang="ts">
import {goToLoginPage} from '..';
import {postRequest} from 'services/http';
import {ref} from 'vue';
import {successToast} from 'services/toast';
import {useRoute} from 'vue-router';
import FormError from 'components/FormError.vue'

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
        margin-bottom: 1rem;
    }

    button {
        font-size: large;
        margin-top: 1rem;
        padding: 0.5rem;
        border-radius: 10px;
    }
</style>