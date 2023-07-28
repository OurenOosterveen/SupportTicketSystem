<template>
    <form class="max-w-100 authbox" @submit.prevent>
        <h1>Nieuw wachtwoord instellen</h1>

        <div class="form-group">
            <label for="password">Wachtwoord</label>
            <FormError name="password" />
            <input id="password" v-model="credentials.password" type="password" name="password" class="form-control" />
        </div>

        <div class="form-group">
            <label for="password_confirmation">Wachtwoord opnieuw</label>
            <FormError name="password_confirmation" />
            <input 
                id="password_confirmation"
                v-model="credentials.password_confirmation" 
                type="password" 
                name="password_confirmation" 
                class="form-control"
            />
        </div>

        <button
            type="submit"
            class="btn btn-primary align-self-end mt-2"
            style="width: 6rem;"
            @click="submit"
        >
            Verzenden
        </button>
        <RouterLink class="align-self-center" style="width: 6rem;" :to="{name: 'Login'}">Terug</RouterLink>
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