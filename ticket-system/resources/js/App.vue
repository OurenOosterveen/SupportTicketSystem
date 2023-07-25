<template>
    <div class="content-view">
        <a v-if="isLoggedIn" @click="logout">Uitloggen</a>
        <RouterView />
    </div>
</template>

<script setup lang="ts">
import {RouterView} from 'vue-router';
import {isLoggedIn, logout} from './auth';
</script>

<style>
.content-view{
    display: grid;
    place-items: center;
    max-width: 1440px;
}
</style>