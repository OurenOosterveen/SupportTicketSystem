<template>
    <Table :tickets="tickets" />
</template>
<script setup lang="ts">
import {computed, onMounted} from 'vue';
import {getLoggedInUser} from 'domains/auth';
import {ticketStore} from '..';
import Table from '../components/Table.vue';

// Show tickets only for current user, all tickets if the current user is an admin
const tickets = computed(() => getLoggedInUser.value?.is_admin
    ? ticketStore.getters.all.value
    : ticketStore.getters.all.value.filter(ticket => ticket.user_id === getLoggedInUser.value?.id),
); 

onMounted(async () => {
    await ticketStore.actions.getAll();
})
</script>
