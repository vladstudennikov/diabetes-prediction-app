<template>
  <h2 class="header-title">{{ text }}</h2>
</template>

<script setup>
    const props = defineProps({ text: String })
</script>

<style scoped>
    .header-title {
        font-size: var(--questions-font-family);
        font-weight: bold;
        color: var(--color-primary);
        text-align: center;
        margin-bottom: 1.5rem;
        font-size: var(--font-large);
    }
</style>