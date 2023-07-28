<template>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Ticket System</a>

        <div id="navbarText" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Overview</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#" @click="logout">Uitloggen</a>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script setup lang="ts">
import {logout} from 'domains/auth';
</script>