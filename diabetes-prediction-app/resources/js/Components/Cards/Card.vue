<template>
    <div
      class="flex flex-col items-center p-6 rounded-xl text-center shadow-md bg-white"
      :style="customStyle"
    >
    
      <img
        :src="icon"
        alt="icon"
        class="w-16 h-16 mb-4"
      />
  
      <h3 class="font-bold text-lg mb-2" :style="{ color: 'var(--card-title-color)' }">
        {{ title }}
      </h3>
  
      <p class="text-sm mb-4" :style="{ color: 'var(--card-text-color)' }">
        {{ description }}
      </p>
  
      <a
        :href="buttonUrl"
        class="px-6 py-2 rounded-full font-medium text-white"
        :style="{
          backgroundColor: 'var(--card-button-bg)',
          color: 'var(--card-button-color)'
        }"
      >
        {{ buttonText }}
      </a>
    </div>
</template>
  
<script setup>
  defineProps({
    icon: String,
    title: String,
    description: String,
    buttonText: String,
    buttonUrl: String,
    customStyle: {
      type: Object,
      default: () => ({})
    }
  })
</script>
  
<style scoped>
  
</style>