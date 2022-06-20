<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Search from '@/Layouts/Pokemon/Search.vue';
import { onMounted, provide, ref } from 'vue';
import { useAttrs } from 'vue'


const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    favoritePokemons: Array
})

const attrs = useAttrs()
const favoriteList = ref(props.favoritePokemons ?? [])

function addToList(pokemon) {
    favoriteList.value.push(pokemon)
}

provide('user', attrs.auth.user ?? null)
provide('favoritePokemons', {
    favoriteList,
    addToList
})

const search = ref('')

</script>

<template>
    <Head title="Pokedex" />

    <div class="flex items-top justify-between  sm:items-center sm:pt-0">
        
        <div class="flex justify-center gap-2 pt-2 pl-20">
            <input type="text" v-model="search" class="text-md outline-none border rounded-md p-1 w-80" placeholder="Pokemon name or id eg. Charizard">
            <Link :href="route('search', { 'search' : search })" class="bg-red-500 rounded p-2 text-white font-bold hover:bg-red-700">Search</Link>
        </div>

        <div v-if="canLogin" class="px-6 py-4 ">
            <template v-if="$page.props.auth.user" >
                <Link :href="route('favorites')" class="text-sm text-gray-700 underline">
                    Favorites
                </Link>
                <Link :href="route('logout')" @click="window.location.reload()" method="post" as="button" class="ml-4  text-sm text-gray-700 underline" >
                    Logout
                </Link>
            </template>
           

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 underline">
                    Log in
                </Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                    Register
                </Link>
            </template>
        </div>

        
        
    </div>
    <div>
        <Search  />
    </div>
</template>


