<template>
    <div class="card mt-2" style="width: 32rem;">
        <div class="card-body">
            <h4 class="card-title">{{ ticket.title }}</h4>
            <div class="card-subtitle text-muted small d-flex justify-content-between">
                <div>{{ getCategory(ticket.category_id) }}</div>
                <div>Status: {{ getStatus(ticket.status_id) }}</div>
            </div>
            <div class="card-subtitle text-muted small d-flex justify-content-between">
                <div>Door: {{ getUserName(ticket.user_id) }}</div>
                <div>Toegewezen aan: {{ getUserName(ticket.assignee_id) }}</div>
            </div>
            <p class="card-text">{{ ticket.content }}</p>
            <div class="card-subtitle text-muted small d-flex justify-content-between">
                <div>Gemaakt op {{ ticket.created_at }}</div>
                <div v-if="ticket.created_at !== ticket.updated_at">Laatste update op: {{ ticket.updated_at }}</div>
            </div>
            <RouterLink :to="{name: 'tickets.overview'}">Terug naar overview</RouterLink>
        </div>
    </div>
</template>
<script setup lang="ts">
import {RouterLink} from 'vue-router';
import {categoryStore} from 'domains/categories';
import {getCurrentRouteId} from 'services/router';
import {statusStore} from 'domains/status';
import {ticketStore} from '..';
import {userStore} from 'domains/users';

ticketStore.actions.getById(getCurrentRouteId());
userStore.actions.getAll();
statusStore.actions.getAll();
categoryStore.actions.getAll();
const ticket = ticketStore.getters.byId(getCurrentRouteId());


const getUserName = (id: number) => {
    const user = userStore.getters.all.value.find(item => item.id === id);
    
    return `${user?.first_name} ${user?.last_name}`
}

const getCategory = (id: number) => categoryStore.getters.all.value.find(item => item.id === id)?.title;
const getStatus = (id: number) => statusStore.getters.all.value.find(item => item.id === id)?.title;

</script>