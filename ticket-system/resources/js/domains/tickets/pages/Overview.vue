<template>
    <TicketTable v-if="sortedTickets.length" :tickets="sortedTickets" />
</template>
<script setup lang="ts">
import {computed} from 'vue';
import {sortBy} from 'services/helpers/sort';
import {ticketStore} from '..';
import TicketTable from '../components/Table.vue';

// Show tickets only for current user, all tickets if the current user is an admin
const tickets = computed(() => ticketStore.getters.all.value); 

const sortedTickets = computed(() => sortBy(tickets.value, 'created_at'));

ticketStore.actions.getAll();

</script>
