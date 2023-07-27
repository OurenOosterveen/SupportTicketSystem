<template>
    <form class="max-w-100" @submit.prevent="$emit('submit', editable)">
        <div class="form-group">
            <label for="title">Titel</label>
            <FormError name="title" />
            <input id="title" v-model="editable.title" type="text" name="title" class="form-control" />
        </div>

        <div class="form-group">
            <label for="content">Inhoud</label>
            <FormError name="content" />
            <textarea id="content" v-model="editable.content" name="content" class="form-control" />
        </div>

        <div class="form-group">
            <label for="category">Categorie</label>
            <FormError name="category" />
            <select id="category" v-model="editable.category_id" class="form-select">
                <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id">
                    {{ category.title }}
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <FormError name="category" />
            <select id="status" v-model="editable.status_id" class="form-select">
                <option v-for="status in statuses" :key="status.id" :value="status.id">{{ status.title }}</option>
            </select>
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
    editable: Updatable<Ticket>
}>();

defineEmits<{
    (event: 'submit', data: Updatable<Ticket>): void;
    (event: 'cancel'): void;
}>();

const categories = categoryStore.getters.all;
const statuses = statusStore.getters.all;

onMounted(async () => {
    await categoryStore.actions.getAll();
    await statusStore.actions.getAll();
})
</script>