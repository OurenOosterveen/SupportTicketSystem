<template>
    <table class="ticket-table">
        <tr>
            <th>Ticket ID</th>
            <th>Titel</th>
            <th>Categorie</th>
            <th>Status</th>
            <th>Aangemaakt door</th>
            <th>Aangemaakt op</th>
            <th>Laatste update</th>
            <th>Toegewezen aan</th>
        </tr>
        <tr v-for="ticket in tickets" :key="ticket.id">
            <td>{{ ticket.id }}</td>
            <td>{{ ticket.title }}</td>
            <td>{{ ticket.category_id }}</td>
            <td>{{ ticket.status_id }}</td>
            <td>{{ ticket.user_id }}</td>
            <td>{{ ticket.created_at }}</td>
            <td>{{ ticket.updated_at }}</td>
            <td>{{ ticket.assignee_id }}</td>
        </tr>
    </table>
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
    .ticket-table {
        padding: .5rem;
        background-color:lightskyblue;
        margin-top: 2rem;
        width: 100%;
        border-collapse: collapse;
    }
    td, th {
        text-align: start;
        border: 1px solid grey;
    }
</style>