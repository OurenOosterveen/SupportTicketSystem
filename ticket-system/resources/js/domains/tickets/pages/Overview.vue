<template>
    <div v-for="ticket in tickets" :key="ticket.id" class="ticket-card">
        <h2> {{ ticket.title }} </h2>
        <p> {{ ticket.content }} </p>
    </div>
</template>
<script setup lang="ts">
import {onMounted} from 'vue';
import {ticketStore} from '..';

const tickets =  ticketStore.getters.all; 

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