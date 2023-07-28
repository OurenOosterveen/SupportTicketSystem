<template>
    <button class="btn btn-primary" style="width: fit-content;" @click="createCategoryModal">Nieuwe category</button>
    <table class="table">
        <thead>
            <tr>
                <th>Categorie ID</th>
                <th>Titel</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="category in categories" :key="category.id">
                <td>{{ category.id }}</td>
                <td>
                    {{ category.title }}
                </td>
                <td>
                    <div class="dropdown show">
                        <a
                            id="dropdownMenuLink"
                            class="btn btn-secondary dropdown-toggle"
                            href="#" 
                            role="button" 
                            data-toggle="dropdown" 
                            aria-haspopup="true" 
                            aria-expanded="false"
                        >
                            Actions
                        </a>
    
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#" @click="updateCategoryModal(category)">Updaten</a>
                            <a class="dropdown-item" href="#" @click="deleteCategory(category)">Verwijderen</a>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script setup lang="ts">
import {Category} from '../types';
import {New, Updatable} from 'services/store/types';
import {categoryStore} from '..';
import {confirmModal, formModal, showModal} from 'services/modal';
import {defineAsyncComponent, ref} from 'vue';
import {successToast} from 'services/toast';
import {ticketStore} from 'domains/tickets';

ticketStore.actions.getAll();

defineProps<{categories: Category[]}>();

const newCategory = ref<New<Category>>({title: ''})

const createCategoryModal = () => {
    formModal(
        newCategory.value,
        defineAsyncComponent(() => import('./Form.vue')),
        async (category: New<Category>) => {
            await categoryStore.actions.create(category);
            successToast('Categorie aangemaakt');
        },
    )
}

const updateCategoryModal = (updatedCategory: Category) => {
    formModal(
        updatedCategory,
        defineAsyncComponent(() => import('./Form.vue')),
        async (category: Updatable<Category>) => {
            await categoryStore.actions.update(category.id, category);
            successToast('Categorie aangepast');
        },
    )
}

const deleteCategory = async (category: Category) => {
    if (ticketStore.getters.all.value.filter(ticket => ticket.category_id === category.id).length) {
        showModal(defineAsyncComponent(() => import('./DeleteWarning.vue')));
        
        return;
    }
    const confirmed = await confirmModal('Weet je zeker dat je deze categorie wilt verwijderen?', 'Verwijderen');
    if (confirmed) {
        await categoryStore.actions.delete(category.id);
        successToast('Categorie verwijderd');
    }
}

</script>