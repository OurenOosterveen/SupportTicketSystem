<template>
    <div class="card mt-2" style="width: 32rem;">
        <div class="card-body">
            <div class="card-subtitle text-muted small d-flex justify-content-between">
                <h4 class="card-title">{{ ticket.title }}</h4>
                <button
                    v-if="isLoggedInUserAdmin"
                    class="btn btn-primary" 
                    @click="changeStatusModal"
                >
                    Status aanpassen
                </button>
            </div>
            <div class="card-subtitle text-muted small d-flex justify-content-between mt-2">
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
import {Ticket} from '../types';
import {Updatable} from 'services/store/types';
import {categoryStore} from 'domains/categories';
import {defineAsyncComponent} from 'vue';
import {formModal} from 'services/modal';
import {getCurrentRouteId} from 'services/router';
import {isLoggedInUserAdmin} from 'domains/auth';
import {statusStore} from 'domains/status';
import {successToast} from 'services/toast';
import {ticketStore} from '..';
import {userStore} from 'domains/users';

ticketStore.actions.getById(getCurrentRouteId());
userStore.actions.getAll();
statusStore.actions.getAll();
categoryStore.actions.getAll();

const ticket = ticketStore.getters.byId(getCurrentRouteId());

const getUserName = (id: number) => {
    const user = userStore.getters.byId(id).value;
    
    return `${user?.first_name} ${user?.last_name}`
}

const getCategory = (id: number) => categoryStore.getters.byId(id).value.title;
const getStatus = (id: number) => statusStore.getters.byId(id).value.title;

const changeStatusModal = () => {
    formModal(
        ticket.value,
        defineAsyncComponent(() => import('../components/ChangeStatus.vue')),
        async (updatedTicket: Updatable<Ticket>) => {
            await ticketStore.actions.update(updatedTicket.id, updatedTicket)
            successToast('Ticket aangepast');
        },
    )
}

</script>