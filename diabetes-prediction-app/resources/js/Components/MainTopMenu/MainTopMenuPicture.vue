<script setup>
    import { Link } from '@inertiajs/vue3';

    defineProps({ 
        imageUrl: String,
        pageUrl: String,
    })
</script>

<template>
    <Link :href="pageUrl">
        <img :src="imageUrl" alt="Top menu logo" class="top-menu-logo">
    </Link>
</template>

<script></script>

<style scoped>
    .top-menu-logo {
        width: var(--top-menu-logo-width);
        height: var(--top-menu-logo-height);
    }
</style>