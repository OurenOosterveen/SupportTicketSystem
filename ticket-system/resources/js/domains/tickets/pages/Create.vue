<template>
    <TicketForm :form="ticket" />
</template>
<script setup lang="ts">
import {New} from 'services/store/types';
import {Ticket} from '../types';
import TicketForm from '../components/Form.vue';

const ticket: New<Ticket> = {
    title: '',
    content: '',
    created_at: '',
    updated_at: '',
    user_id: -1,
    status_id: 1,
    category_id: 1,
    assignee_id: -1,
}
</script>