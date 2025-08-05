<template>
  <button class="submit-button">{{ text }}</button>
</template>

<script setup>
    const props = defineProps({ text: String })
</script>

<style scoped>
    .submit-button {
      background-color: var(--color-button);
      color: var(--color-button-text);
      padding: 0.5rem 2rem;
      border-radius: 20px;
      border: none;
      font-size: var(--font-base);
      font-weight: bold;
      margin-top: 2rem;
      cursor: pointer;
    }
</style>