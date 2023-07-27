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
            <td>{{ getCategory(ticket.category_id) }}</td>
            <td>{{ getStatus(ticket.status_id) }}</td>
            <td>{{ getUserName(ticket.user_id) }}</td>
            <td>{{ ticket.created_at }}</td>
            <td>{{ ticket.updated_at }}</td>
            <td>{{ getUserName(ticket.assignee_id) }}</td>
        </tr>
    </table>
</template>
<script setup lang="ts">
import {Ticket} from '../types';
import {categoryStore} from 'domains/categories';
import {onMounted} from 'vue';
import {statusStore} from 'domains/status';
import {userStore} from 'domains/users'

defineProps<{tickets: Ticket[]}>();

const getUserName = (id: number) => {
    const user = userStore.getters.byId(id).value;

    return `${user.first_name} ${user.last_name}`
}

const getCategory = (id: number) => categoryStore.getters.byId(id).value.title;
const getStatus = (id: number) => statusStore.getters.byId(id).value.title;

onMounted(async () => {
    await userStore.actions.getAll();
    await statusStore.actions.getAll();
    await categoryStore.actions.getAll();
});
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