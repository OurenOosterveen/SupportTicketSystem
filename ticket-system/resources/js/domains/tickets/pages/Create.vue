<template>
    <div>
        <h3>Nieuwe ticket toevoegen</h3>
        <TicketForm :editable="newTicket" @submit="save" />
    </div>
</template>
<script setup lang="ts">
import {New} from 'services/store/types';
import {Ticket} from '../types';
import {successToast} from 'services/toast';
import {ticketStore} from '..';
import TicketForm from '../components/Form.vue';

const newTicket: New<Ticket> = {
    title: '',
    content: '',
    created_at: '',
    updated_at: '',
    user_id: -1,
    status_id: 1,
    category_id: 1,
    assignee_id: -1,
}

const save = async (ticket: New<Ticket>) => {
    await ticketStore.actions.create(ticket)
    successToast('Nieuwe ticket toegevoegd');
}
</script>