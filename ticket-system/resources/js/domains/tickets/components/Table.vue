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
import {Ticket} from '../types';

defineProps<{tickets: Ticket[]}>()
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