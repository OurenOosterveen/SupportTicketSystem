<template>
    <table class="table">
        <thead>
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
        </thead>
        <tbody>
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
        </tbody>
    </table>
</template>
<script setup lang="ts">
import {Ticket} from '../types';
import {categoryStore} from 'domains/categories';
import {onMounted} from 'vue';
import {statusStore} from 'domains/status';
import {userStore} from 'domains/users'

defineProps<{tickets: Ticket[]}>();

const categories = categoryStore.getters.all;
const statuses = statusStore.getters.all;
const users = userStore.getters.all;


const getUserName = (id: number) => {
    const user = users.value.find(item => item.id === id);

    return `${user?.first_name} ${user?.last_name}`
}

const getCategory = (id: number) => categories.value.find(item => item.id === id)?.title;
const getStatus = (id: number) => statuses.value.find(item => item.id === id)?.title;

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
        width: 100%;
        border-collapse: collapse;
    }
</style>