<template>
    <CategoryTable :categories="categories" />
</template>
<script setup lang="ts">
import {categoryStore} from '..';
import CategoryTable from '../components/Table.vue';

categoryStore.actions.getAll();
const categories = categoryStore.getters.all;

</script>