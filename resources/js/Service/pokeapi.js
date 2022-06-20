import { useMutation, useQuery } from "vue-query"


function usePokemonList(ref) {
  return useQuery(['pokemons', ref], async () => {
    const response = await window.axios.get(`/pokeapi/pokemons/${ref.value}`)
    return response.data
  })
}

function useAddFavorite() {
  return useMutation(async (newFavorite) => {
    let bodyFormData = new FormData()
    bodyFormData.append('pokemon_id', newFavorite.pokemonId)
    const response = await window.axios.post(`/pokemon/favorite`, bodyFormData)
    return response.data
  })
}

function useRemoveFavorite(ref) {
  return useMutation(async (newFavorite) => {
    const response = await window.axios.post(`/pokemon/unfavorite`, {
      pokemon_id: newFavorite.id
    })
    return response.data
  })
}




export {
  usePokemonList,
  useAddFavorite,
  useRemoveFavorite
}
