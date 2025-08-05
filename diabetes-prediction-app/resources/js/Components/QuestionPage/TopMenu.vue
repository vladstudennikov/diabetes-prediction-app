<template>
  <div class="top-menu">
    <img :src="iconUrl" alt="icon" class="menu-icon" />
    <span class="menu-text">{{ text }}</span>
  </div>
</template>

<script setup>
    const props = defineProps({
      iconUrl: String,
      text: String
    })
</script>

<style scoped>
    .top-menu {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem;
    }
    .menu-icon {
    height: 50px;
    margin-right: 1rem;
    }
    .menu-text {
    font-size: var(--font-small);
    color: var(--color-text);
    }
</style>