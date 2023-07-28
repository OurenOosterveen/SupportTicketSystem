<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="#">Ticket System</a>

        <div id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <RouterLink :to="{name: 'tickets.overview'}" class="nav-link">Tickets</RouterLink>
                </li>
                <li v-if="isLoggedInUserAdmin" class="nav-item active">
                    <RouterLink :to="{name: 'categories.overview'}" class="nav-link">Categorieën</RouterLink>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#" @click="logout">Uitloggen</a>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script setup lang="ts">
import {RouterLink} from 'vue-router';
import {isLoggedInUserAdmin, logout} from 'domains/auth';
</script>