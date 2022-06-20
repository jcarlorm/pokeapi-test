
<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import connect from '@/Service/connect'
import { inject, onMounted, ref, watch } from 'vue'
import { useSwalCofirm } from '@/Composables/useSwal';

const props = defineProps({
  pokemon: {
    type: Object
  }
})

const emit = defineEmits(['delete'])

const favorite = ref(false)
const user  = inject('user')
const {favoriteList , addToList} = inject('favoritePokemons')

const { isLoading, data, isError, error, isSuccess,  mutate:  mutateAdd  } = connect.useAddFavorite()
const {  isSuccess: isSuccessRemove, mutate: mutateRemove  } = connect.useRemoveFavorite()

const updateFavorite = () => {
  if (!favorite.value) {
    mutateAdd({
      pokemonId: props.pokemon.id
    })
    favorite.value = true
  } else {
    useSwalCofirm().then(result => {
      if (result.value) {
         mutateRemove({
          pokemonId: props.pokemon.id
        })
        favorite.value = false
        emit('delete', props.pokemon)
      }
    })
  }
}

onMounted(() => {
  const findPokemon = favoriteList.value.find(pokemon => pokemon.pokemon_id === props.pokemon.id)
  if (findPokemon) {
    favorite.value = true
  }
})

watch(isSuccess, () => {
  if (isSuccess) {
    window.Swal.fire('Success', 'Pokemon added to favorites', 'success')
  }
})

watch(isSuccessRemove, () => {
  if (isSuccessRemove) {
    window.Swal.fire('Success', 'Pokemon removed from favorites', 'success')
  }
})


</script>

<template>
  
  <div class="relative pt-32">
    <div class="grid place-items-center bg-gray-100 rounded-lg shadow-lg shadow-gray-400/50 w-60">
        <div class="w-48 -mt-32">
          <img :src="pokemon.sprites.other.home.front_default">
        </div>
        <div class="pt-2 w-full">
        <h1 class="text-2xl text-center text-gray-700 font-bold">{{ pokemon.name }}</h1>
        <div class="flex justify-around text-xs text-gray-600 py-4">
            <div class="text-center">
              <p class="font-bold text-lg">{{pokemon.weight}}</p>
              <p>weigth</p>
            </div>
            <div class="text-center">
              <p class="font-bold text-lg">{{ pokemon.types.map(type => type.type.name).join(' | ') }}</p>
              <p>type</p>
            </div>
            <div class="text-center">
              <p class="font-bold text-lg">{{pokemon.height}}</p>
              <p>height</p>
            </div>
        </div>
        <div v-if="user" 
          class="flex text-sm justify-center gap-2 items-center pb-2 cursor-pointer text-gray-300"
          :class="{'text-gray-300': !favorite , 'text-red-600': favorite}"
          @click="updateFavorite"
          >
              <template v-if="!favorite">
                <font-awesome-icon icon="fa-solid fa-star" class="hover:text-yellow-300"/>
                <p class="hover:text-gray-600 underline">add to favorites</p>
              </template>
              <template v-else>
                <font-awesome-icon icon="fa-solid fa-star" class="hover:text-red-700"/>
                <p class="hover:text-red-700 underline">remove from favorites</p>
              </template>
        </div>
        <div v-else
          class="flex text-sm justify-center gap-1 items-center pb-2 cursor-pointer text-gray-300"
          >
          <Link :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
              Register to create your favorites
          </Link>
        </div>
      </div> 
    </div>
  </div>


</template>
