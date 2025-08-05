<script setup>
    import { Link } from '@inertiajs/vue3';

    defineProps({ 
        text: String, 
        pageUrl: String 
    })
</script>

<template>
    <Link :href="pageUrl" class="top-menu-option"><p class="top-menu-option-text">{{ text }}</p></Link>
</template>

<script></script>

<style scoped>
    .top-menu-option {
        display: flex;
        align-items: center;
        padding: var(--top-menu-option-padding)
    }

    .top-menu-option-text {
        font-family: var(--top-menu-font);
        font-size: var(--top-menu-font-size);
        display: inline-block;
        padding: 0;
    }
</style>