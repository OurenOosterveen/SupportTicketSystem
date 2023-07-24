<template>
    <div class="content-view">
        <RouterView />
    </div>
</template>

<script setup lang="ts">
import {RouterView} from 'vue-router';
</script>

<style>
.content-view{
    display: grid;
    place-items: center;
}
</style>