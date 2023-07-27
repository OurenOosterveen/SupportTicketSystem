<template>
    <div v-for="error in getErrorByProperty(name).value" :key="error" class="error">{{ error }}</div>
</template>

<script setup lang="ts">
import {getErrorByProperty} from 'services/error'

defineProps<{name: string}>()
</script>

<style>
    .error {
        color: red;
        font-size: small;
    }
</style>