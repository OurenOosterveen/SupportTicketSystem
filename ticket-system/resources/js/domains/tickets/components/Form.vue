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
            <FormError name="category_id" />
            <select id="category" v-model="editable.category_id" class="form-select">
                <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                >
                    {{ category.title }}
                </option>
            </select>
        </div>

        <div class="d-flex justify-content-end mt-2">
            <button type="button" class="btn btn-primary" @click="$emit('cancel')">Annuleren</button>
            <button type="submit" class="btn btn-primary">Opslaan</button>
        </div>
    </form>
</template>
<script setup lang="ts">
import {New, Updatable} from 'services/store/types';
import {Ticket} from '../types';
import {categoryStore} from 'domains/categories';
import {deepCopy} from 'services/helpers/copy';
import {ref} from 'vue';
import {statusStore} from 'domains/status';
import FormError from 'components/FormError.vue';

const props = defineProps<{
    form: New<Ticket> | Updatable<Ticket>
}>();

defineEmits<{
    (event: 'submit', ticket: New<Ticket> | Updatable<Ticket>): void;
    (event: 'cancel'): void;
}>();

const editable = ref(deepCopy(props.form))

const categories = categoryStore.getters.all;

categoryStore.actions.getAll();
statusStore.actions.getAll();

</script>
<style>
button {
    margin-left: 1rem;
    width: auto;
}
</style>