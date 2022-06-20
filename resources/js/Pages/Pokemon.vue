<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

import Card from '@/Layouts/Pokemon/CardDetail.vue';
import { provide, ref } from 'vue';


const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    favoritePokemons: Array,
    user: Object,
    pokemonData: Object,
})
const favoriteList = ref(props.favoritePokemons ?? [])

function addToList(pokemon) {
    favoriteList.value.push(pokemon)
}

provide('user', props.user ?? null)
provide('favoritePokemons', {
    favoriteList,
    addToList
})

</script>


<template>

    <Head title="Pokemon" />
    
    <div class="h-screen grid place-items-center">

      <Card :pokemon="pokemonData"  ></Card>
      
    </div>
    
</template>
