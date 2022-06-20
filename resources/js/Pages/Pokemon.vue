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

        <template v-if="pokemonData">
            <Card :pokemon="pokemonData"  ></Card>
        </template>

        <template v-else>
            <div class="text-red-600 text-xl" >Pokemon Not Found</div>
        </template>

        <Link :href="route('home')" class="bg-red-500 p-2 text-white font-bold text-xl rounded hover:bd-red-700">
            Go back to Pokemon List
        </Link>

      
    </div>
    
</template>
