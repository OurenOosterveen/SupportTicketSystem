<template>
    <div v-for="ticket in tickets" :key="ticket.id">
        {{ ticket.title }}
    </div>
</template>
<script setup lang="ts">
import {onMounted} from 'vue';
import {ticketStore} from '..';

const tickets = ticketStore.getters.all; 

onMounted(async () => {
    await ticketStore.actions.getAll();
    console.log(ticketStore.getters.all)
})
</script>