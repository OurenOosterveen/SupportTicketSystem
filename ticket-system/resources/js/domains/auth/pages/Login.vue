<template>
    <form class="authbox" @submit.prevent>
        <h1>Ticket systeem</h1>
        
        <div class="form-group">
            <label for="email">E-mail</label>
            <FormError name="email" />
            <input id="email" v-model="credentials.email" type="email" name="email" class="form-control" />
        </div>

        <div class="form-group">
            <label for="password">Wachtwoord</label>
            <FormError name="password" />
            <input id="password" v-model="credentials.password" type="password" name="password" class="form-control" />
        </div>

        <FormError name="credentials" />


        <button
            type="submit"
            class="btn btn-primary align-self-end mt-2"
            style="width: 6rem;"
            @click="submit"
        >
            Log in
        </button>

        <RouterLink :to="{name: 'forgotPassword'}" style="font-size: small; align-self: center;">
            Wachtwoord vergeten?
        </RouterLink>
    </form>
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
