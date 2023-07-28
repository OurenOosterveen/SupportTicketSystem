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
import {defineAsyncComponent, ref} from 'vue';
import {formModal} from 'services/modal';
import {successToast} from 'services/toast';

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

</script>