<template>
    <button class="btn btn-primary" style="width: 8rem;" @click="createTicketModal">Nieuwe ticket</button>
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
                <th>#</th>
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
                <td><button @click="updateTicketModal(ticket)">updaten</button></td>
            </tr>
        </tbody>
    </table>
</template>
<script setup lang="ts">
import {New, Updatable} from 'services/store/types';
import {Ticket} from '../types';
import {categoryStore} from 'domains/categories';
import {defineAsyncComponent, ref} from 'vue';
import {formModal} from 'services/modal';
import {statusStore} from 'domains/status';
import {successToast} from 'services/toast';
import {ticketStore} from '..';
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

const newTicket = ref<New<Ticket>>({
    title: '',
    content: '',
    created_at: '',
    updated_at: '',
    user_id: -1,
    status_id: 1,
    category_id: 1,
    assignee_id: -1,
})

const createTicketModal = () => {
    formModal(
        newTicket.value,
        defineAsyncComponent(() => import('./Form.vue')),
        async (ticket: New<Ticket>) => {
            await ticketStore.actions.create(ticket)
            successToast('Nieuwe ticket toegevoegd');
        },
    )
}

const updateTicketModal = (updatedTicket: Ticket) => {
    formModal(
        updatedTicket,
        defineAsyncComponent(() => import('./Form.vue')),
        async (ticket: Updatable<Ticket>) => {
            await ticketStore.actions.update(ticket.id, ticket)
            successToast('Ticket aangepast');
        },
    )
}

userStore.actions.getAll();
statusStore.actions.getAll();
categoryStore.actions.getAll();
</script>
<style>
    .ticket-table {
        padding: .5rem;
        background-color:lightskyblue;
        width: 100%;
        border-collapse: collapse;
    }
</style>