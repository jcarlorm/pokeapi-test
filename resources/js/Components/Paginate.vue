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

defineEmits(['update:currentPage'])

</script>

<template>
<div class="flex gap-2" v-show="totalPages > 1">
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

</div>


</template>