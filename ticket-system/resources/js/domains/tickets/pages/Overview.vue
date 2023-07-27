<template>
    <div v-for="ticket in tickets" :key="ticket.id" class="ticket-card">
        <h2> {{ ticket.title }} </h2>
        <p> {{ ticket.content }} </p>
    </div>
</template>
<script setup lang="ts">
import {computed, onMounted} from 'vue';
import {getLoggedInUser} from 'domains/auth';
import {ticketStore} from '..';

// Show tickets only for current user, all tickets if the current user is an admin
const tickets = computed(() => getLoggedInUser.value?.is_admin
    ? ticketStore.getters.all.value
    : ticketStore.getters.all.value.filter(ticket => ticket.user_id === getLoggedInUser.value?.id),
); 

onMounted(async () => {
    await ticketStore.actions.getAll();
})
</script>
<style>
    .ticket-card {
        padding: .5rem;
        background-color:lightskyblue;
        border-radius: 15px;
        margin-top: 2rem;
        width: 100%;
    }
</style>