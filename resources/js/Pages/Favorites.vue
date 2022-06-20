<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    favoritePokemons: Array,
    user: Object
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
</template>
