<template>
    <form class="max-w-100" @submit.prevent="$emit('submit', editable)">
        <div class="form-group">
            <label for="title">Titel</label>
            <FormError name="title" />
            <input id="title" v-model="editable.title" type="text" name="title" class="form-control" />
        </div>

        <div class="d-flex justify-content-end mt-2">
            <button type="button" class="btn btn-primary" @click="$emit('cancel')">Annuleren</button>
            <button type="submit" class="btn btn-primary">Opslaan</button>
        </div>
    </form>
</template>
<script setup lang="ts">
import {Category} from '../types';
import {Updatable} from 'services/store/types';
import {deepCopy} from 'services/helpers/copy';
import {ref} from 'vue';

const props = defineProps<{
    form: Updatable<Category>
}>();

const editable = ref(deepCopy(props.form))

defineEmits<{
    (event: 'submit', ticket: Updatable<Category>): void;
    (event: 'cancel'): void;
}>();
</script>
<style>
button {
    margin-left: 1rem;
    width: auto;
}
</style>