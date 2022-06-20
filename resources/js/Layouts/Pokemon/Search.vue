<script setup>

import connect from '@/Service/connect';
import { inject, ref } from 'vue';
import Card from './Card.vue';
import Paginate from '@/Components/Paginate.vue';

const perPage = ref(10)
const currentPage = ref(1)
const { isLoading, data } = connect.usePokemonList(currentPage)

</script>

<template>
    <div v-show="isLoading" class="text-center">
      ...loading
    </div>

    <div v-show="!isLoading" >
  
      <div v-if="data && data.pokemonsData && data.pokemonsPaginate">
        <div class="flex gap-8 flex-wrap justify-center">
          <Card v-for="pokemon in data.pokemonsData" :pokemon="pokemon" :key="pokemon.id" />
        </div>
      
        <div class="flex justify-center pt-10 pb-2">
          <Paginate
              :totalRecords="data.pokemonsPaginate.count" 
              :perPage="perPage" 
              v-model:currentPage="currentPage" />
        </div>
      </div>
    </div>
</template>