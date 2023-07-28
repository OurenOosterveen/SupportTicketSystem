<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand ml-4" href="#">Ticket System</a>

        <div id="navbarText" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <RouterLink :to="{name: 'tickets.overview'}" class="nav-link">Tickets</RouterLink>
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
import {logout} from 'domains/auth';
</script>