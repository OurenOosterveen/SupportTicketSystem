<template>
    <!-- <button class="btn btn-primary" style="width: 8rem;" @click="createCategoryModal">Nieuwe category</button> -->
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
    
                        <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#" @click="updateCategoryModal(category)">Updaten</a>
                        </div> -->
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script setup lang="ts">
import {Category} from '../types';

defineProps<{categories: Category[]}>();

</script>