<template>
    <form class="max-w-100" @submit.prevent="$emit('submit', editable)">
        <h3>Status van de ticket aanpassen</h3>
        <div class="form-group">
            <label for="status">Status</label>
            <FormError name="status_id" />
            <select id="status" v-model="editable.status_id" class="form-select">
                <option v-for="status in statuses" :key="status.id" :value="status.id">{{ status.title }}</option>
            </select>
        </div>
        <div class="d-flex justify-content-end mt-2">
            <button type="button" class="btn btn-primary" @click="$emit('cancel')">Annuleren</button>
            <button type="submit" class="btn btn-primary ml-2">Opslaan</button>
        </div>
    </form>
</template>
<script setup lang="ts">
import {Ticket} from '../types';
import {Updatable} from 'services/store/types';
import {deepCopy} from 'services/helpers/copy';
import {ref} from 'vue';
import {statusStore} from 'domains/status';
import FormError from 'components/FormError.vue';

const props = defineProps<{
    form: Updatable<Ticket>
}>();

defineEmits<{
    (event: 'submit', ticket: Updatable<Ticket>): void;
    (event: 'cancel'): void;
}>();

const editable = ref(deepCopy(props.form));
const statuses = statusStore.getters.all;

</script>