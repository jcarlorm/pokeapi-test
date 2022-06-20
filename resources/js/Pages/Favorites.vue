<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Card from '@/Layouts/Pokemon/Card.vue';
import { provide, ref, watch } from 'vue';
import Paginate from '@/Components/Paginate.vue';

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    favoritePokemons: Array,
    user: Object,
    pokemonsData: Array,
})

const favoriteList = ref(props.favoritePokemons ?? [])
const perPage = ref(10)
const currentPage = ref(1)
const viewPokemons = ref(props.pokemonsData)
const pokemonsDataChunk = window._.chunk(viewPokemons.value, perPage.value)
const pokemonsCurrentData = ref(pokemonsDataChunk[currentPage.value - 1])

function addToList(pokemon) {
    favoriteList.value.push(pokemon)
}

watch(currentPage, (newValue) => {
    pokemonsCurrentData.value = pokemonsDataChunk[currentPage.value - 1]
})

function remove(pokemon) {
    favoriteList.value = favoriteList.value.filter(item => item.pokemon_id !== pokemon.id)
    viewPokemons.value = viewPokemons.value.filter(item => item.id !== pokemon.id)
    pokemonsDataChunk.value = window._.chunk(viewPokemons.value, perPage.value)
    console.log(pokemonsDataChunk.value[0])
    pokemonsCurrentData.value = pokemonsDataChunk.value[0]
    currentPage.value = 1
}


provide('user', props.user)
provide('favoritePokemons', {
    favoriteList,
    addToList
})

</script>

<template>
    <Head title="Favorites" />

    <div class="flex items-top justify-end  sm:items-center sm:pt-0">
        <div v-if="canLogin" class="px-6 py-4 sm:block">
            <Link :href="route('home')" class="text-sm text-gray-700 underline">
                View all Pokemons
            </Link>
            <Link :href="route('logout')" @click="window.location.reload()" method="post" as="button" class="ml-4  text-sm text-gray-700 underline" >
                Logout
            </Link>
        </div>
    </div>

    <div>
        <div class="flex gap-8 flex-wrap justify-center">
            <template  v-if="pokemonsCurrentData">
                <Card @delete="remove" v-for="pokemon in pokemonsCurrentData" :pokemon="pokemon" :key="pokemon.id" />
            </template>
            <template v-else>
                <Link :href="route('home')" class="text-lg font-bold text-white mt-60 bg-red-600 p-4 rounded">
                    View all Pokemons
                </Link>
            </template>
        </div>

        <div class="flex justify-center pt-10 pb-2">
            <Paginate
                :totalRecords="pokemonsData.length" 
                :perPage="perPage" 
                v-model:currentPage="currentPage" />
        </div>
    </div>
</template>
