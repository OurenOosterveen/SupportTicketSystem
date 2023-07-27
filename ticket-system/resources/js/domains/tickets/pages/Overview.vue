<template>
    <div class="content">
        <RouterLink :to="{name: 'tickets.create'}">Nieuwe ticket</RouterLink>
        <Table v-if="tickets.length" :tickets="tickets" />
    </div>
</template>
<script setup lang="ts">
import {RouterLink} from 'vue-router';
import {computed} from 'vue';
import {getLoggedInUser} from 'domains/auth';
import {ticketStore} from '..';
import Table from '../components/Table.vue';

// Show tickets only for current user, all tickets if the current user is an admin
const tickets = computed(() => getLoggedInUser.value?.is_admin
    ? ticketStore.getters.all.value
    : ticketStore.getters.all.value.filter(ticket => ticket.user_id === getLoggedInUser.value?.id),
); 

ticketStore.actions.getAll();

</script>
<style>
    .content {
        margin-top: 2rem;
        width: 100%;
    }
</style>
