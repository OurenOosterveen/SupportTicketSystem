<template>
    <div class="content-view">
        <button v-if="isLoggedIn" class="btn btn-primary" style="width: 8rem;" @click="logout">Uitloggen</button>
        <RouterView />
    </div>
</template>

<script setup lang="ts">
import {RouterView} from 'vue-router';
import {isLoggedIn, logout} from 'domains/auth';
</script>

<style>
.content-view{
    display: grid;
    place-items: center;
    max-width: 1440px;
}
</style>