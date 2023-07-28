<template>
    <form class="max-w-100" @submit.prevent="$emit('submit', editable)">
        <h3>Administrator aanpassen</h3>
        <div class="form-group">
            <label for="admin">Administrator</label>
            <FormError name="assignee_id" />
            <select id="admin" v-model="editable.assignee_id" class="form-select">
                <option v-for="user in admins" :key="user.id" :value="user.id">{{ getUserName(user) }}</option>
            </select>
        </div>
        <button type="button" class="btn btn-primary" @click="$emit('cancel')">Annuleren</button>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</template>
<script setup lang="ts">
import {Ticket} from '../types';
import {Updatable} from 'services/store/types';
import {User} from 'domains/auth/types';
import {deepCopy} from 'services/helpers/copy';
import {ref} from 'vue';
import {userStore} from 'domains/users';
import FormError from 'components/FormError.vue';

const admins = userStore.getters.all.value.filter(user => user.is_admin)

const props = defineProps<{
    form: Updatable<Ticket>
}>();

defineEmits<{
    (event: 'submit', ticket: Updatable<Ticket>): void;
    (event: 'cancel'): void;
}>();

const editable = ref(deepCopy(props.form))

const getUserName = (user: User) => `${user?.first_name} ${user?.last_name}`

</script>