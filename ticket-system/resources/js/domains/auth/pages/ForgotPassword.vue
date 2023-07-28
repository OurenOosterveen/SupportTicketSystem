<template>
    <form class="max-w-100 authbox" @submit.prevent>
        <h1>Wachtwoord vergeten</h1>

        <div class="form-group">
            <label for="email">E-mail</label>
            <FormError name="email" />
            <input id="email" v-model="email" type="email" name="email" class="form-control" />
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