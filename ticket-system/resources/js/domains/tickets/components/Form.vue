<template>
    <form @submit.prevent>
        <label for="title">Titel</label>
        <FormError name="title" />
        <input id="title" v-model="form.title" type="text" name="title" />

        <label for="content">Inhoud</label>
        <FormError name="content" />
        <textarea id="content" v-model="form.content" name="content" />

        <label for="category">Categorie</label>
        <FormError name="category" />
        <select v-model="form.category_id">
            <option v-for="category in categories" :key="category.id">{{ category.title }}</option>
        </select>

        <label for="category">Status</label>
        <FormError name="category" />
        <select v-model="form.status_id">
            <option v-for="status in statuses" :key="status.id">{{ status.title }}</option>
        </select>
    </form>
</template>
<script setup lang="ts">
import {Ticket} from '../types';
import {Updatable} from 'services/store/types';
import {categoryStore} from 'domains/categories';
import {onMounted} from 'vue';
import {statusStore} from 'domains/status';
import FormError from 'components/FormError.vue';

defineProps<{
    form: Updatable<Ticket>
}>();

const categories = categoryStore.getters.all;
const statuses = statusStore.getters.all;

onMounted(async () => {
    await categoryStore.actions.getAll();
    await statusStore.actions.getAll();
})
</script>