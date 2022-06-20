<script setup>
import { computed } from 'vue';


const props = defineProps({
  totalRecords: {
    type: Number,
    default: 0
  },
  perPage: {
    type: Number,
    default: 10
  },
  currentPage: {
    type: Number,
    default: 1
  }
})

const totalPages = computed(() => {
  return Math.ceil(props.totalRecords / props.perPage)
})

const emit = defineEmits(['update:currentPage'])


const updatePage = (e) => {
  if (e.target.value === '') return 
  if (totalPages < e.target.value) {
    emit('update:currentPage', totalPages)
  } else {
    emit('update:currentPage', e.target.value > 0 ? e.target.value : 1)
  }
}

</script>

<template>
<div class="flex gap-2 items-center" v-show="totalPages > 1">
  <button
    class="bg-white border-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded"
    v-if="currentPage > 1"
    @click="$emit('update:currentPage', currentPage -= 1)">
    Previous
  </button>

  <button
    class="bg-white border-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded"
    v-if="currentPage > 1"
    @click="$emit('update:currentPage', currentPage -= 1 )">
    {{ currentPage - 1 }}
  </button>
    
  <button
  disabled
    class="bg-gray-400 disabled:cursor-not-allowed text-gray-800 font-semibold py-2 px-4 rounded"
  >
    {{ currentPage  }}
  </button>
  
  <button
    class="bg-white border-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded"
    v-if="currentPage < totalPages"
    @click="$emit('update:currentPage', currentPage += 1)">
    {{ currentPage + 1 }}
  </button>

  <button
    class="bg-white border-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded"
    v-if="currentPage < totalPages"
    @click="$emit('update:currentPage', currentPage += 1)">
    Next 
  </button>

  <div class="flex items-center gap-2">
    <div>Go to Page</div>
    <div><input type="text" @keydown.enter="updatePage" class="w-12 rounded-lg" @change="updatePage" :value="currentPage"> </div>
    <div>of {{ totalPages }}</div>
  </div>

</div>


</template>