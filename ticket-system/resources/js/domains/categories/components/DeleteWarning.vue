<template>
    <h3>Categorie kan niet verwijderd worden.</h3>
    <p>
        Deze categorie is gebonden aan tickets. 
        U moet eerst de categorie van de tickets afhalen voordat u deze categorie kan verwijderen.
    </p>
    <button type="button" class="btn btn-primary" @click="$emit('hide')">Annuleren</button>
</template>
<script setup lang="ts">
defineEmits<{(event: 'hide'): void}>();
</script>