<template>
    <form class="max-w-100" @submit.prevent="$emit('submit', copyEditable)">
        <div class="form-group">
            <label for="title">Titel</label>
            <FormError name="title" />
            <input id="title" v-model="copyEditable.title" type="text" name="title" class="form-control" />
        </div>

        <div class="form-group">
            <label for="content">Inhoud</label>
            <FormError name="content" />
            <textarea id="content" v-model="copyEditable.content" name="content" class="form-control" />
        </div>

        <div class="form-group">
            <label for="category">Categorie</label>
            <FormError name="category" />
            <select id="category" v-model="copyEditable.category_id" class="form-select">
                <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                >
                    {{ category.title }}
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <FormError name="category" />
            <select id="status" v-model="copyEditable.status_id" class="form-select">
                <option v-for="status in statuses" :key="status.id" :value="status.id">{{ status.title }}</option>
            </select>
        </div>
        <button type="button" class="btn btn-primary" @click="$emit('cancel')">Annuleren</button>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</template>
<script setup lang="ts">
import {New, Updatable} from 'services/store/types';
import {Ticket} from '../types';
import {categoryStore} from 'domains/categories';
import {deepCopy} from 'services/helpers/copy';
import {onMounted, ref} from 'vue';
import {statusStore} from 'domains/status';
import FormError from 'components/FormError.vue';

const props = defineProps<{
    form: New<Ticket> | Updatable<Ticket>
}>();

defineEmits<{
    (event: 'submit', ticket: New<Ticket> | Updatable<Ticket>): void;
    (event: 'cancel'): void;
}>();

const copyEditable = ref(deepCopy(props.form))

const categories = categoryStore.getters.all;
const statuses = statusStore.getters.all;

onMounted(async () => {
    await categoryStore.actions.getAll();
    await statusStore.actions.getAll();
})
</script>