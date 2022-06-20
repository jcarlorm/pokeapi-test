<script setup>
import { computed } from 'vue';


const props = defineProps({
  stat: {
    type: Object
  }
})

const name = computed(() => {
  return props.stat.stat.name.replace('-', ' ')
})

const percentage = computed(() => {
  return (props.stat.base_stat / 200 * 100).toFixed(2)
})


</script>


<template>
  <div class="flex justify-between items-center">
    <div class="pl-2">{{ name }}</div>
    <div class="pr-2 w-3/5">
      <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
        <div class="bg-gray-500 h-2.5 rounded-full" :style="{width: `${percentage}%` }"></div>
      </div>
    </div>
  </div>
</template>