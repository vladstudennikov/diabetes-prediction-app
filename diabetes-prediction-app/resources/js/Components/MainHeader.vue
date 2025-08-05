<script setup>
    defineProps({ 
        text: String, 
        classes: {
            type: [String, Array, Object],
            default: ''
        }
    })
</script>

<template>
    <h1 :class="classes">{{ text }}</h1>
</template>

<script></script>

<style scoped>
    h1 {
        font-family: var(--main-header-font);
        font-weight: var(--main-header-weight);
        color: var(--main-header-color);
    }
</style>