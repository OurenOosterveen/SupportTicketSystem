<template>
    <div class="content-view">
        <NavBar v-if="isLoggedIn" class="w-100" />
        <div class="content" style="max-width: 1440px; margin-top: 1rem;">
            <RouterView />
        </div>
    </div>
</template>

<script setup lang="ts">
import {RouterView} from 'vue-router';
import {isLoggedIn} from 'domains/auth';
import NavBar from 'components/NavBar.vue';
</script>

<style>
.content-view{
    display: grid;
    place-items: center;
    max-width: 100%;
}
</style>