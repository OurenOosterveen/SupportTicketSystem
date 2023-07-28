<template>
    <CategoryTable v-if="sortedCategories.length" :categories="sortedCategories" />
</template>
<script setup lang="ts">
import {categoryStore} from '..';
import {computed} from 'vue';
import {sortBy} from 'services/helpers/sort';
import CategoryTable from '../components/Table.vue';

categoryStore.actions.getAll();
const categories = categoryStore.getters.all;
const sortedCategories = computed(() => sortBy(categories.value, 'title'));

</script>