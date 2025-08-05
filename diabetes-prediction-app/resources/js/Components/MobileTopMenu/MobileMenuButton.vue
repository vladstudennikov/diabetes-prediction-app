<script setup>
    import { Link } from '@inertiajs/vue3';

    defineProps({ 
        text: String,
        pageUrl: String 
    })
</script>

<template>
    <Link :href="pageUrl"><p class="top-menu-button">{{ text }}</p></Link>
</template>

<script></script>

<style scoped>
    .top-menu-button {
        display: inline-block;
        font-family: var(--top-menu-font);
        font-size: var(--mobile-menu-button-font-size);
        background-color: var(--top-menu-button-color);
        border-radius: var(--top-menu-border-radius);
        color: var(--top-menu-button-text-color);
        padding: var(--top-menu-button-padding);
    }
</style>