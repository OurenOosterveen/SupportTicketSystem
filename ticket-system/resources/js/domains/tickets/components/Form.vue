<template>
    <form class="max-w-100" @submit.prevent>
        <div class="form-group">
            <label for="title">Titel</label>
            <input id="title" v-model="form.title" type="text" name="title" class="form-control" />
            <FormError name="title" />
        </div>

        <div class="form-group">
            <label for="content">Inhoud</label>
            <textarea id="content" v-model="form.content" name="content" class="form-control" />
            <FormError name="content" />
        </div>

        <div class="form-group">
            <label for="category">Categorie</label>
            <select id="category" v-model="form.category_id" class="form-select">
                <option v-for="category in categories" :key="category.id">{{ category.title }}</option>
            </select>
            <FormError name="category" />
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" v-model="form.status_id" class="form-select">
                <option v-for="status in statuses" :key="status.id">{{ status.title }}</option>
            </select>
            <FormError name="category" />
        </div>
        <button type="submit" class="btn btn-primary">Aanmaken</button>
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