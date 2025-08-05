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

<style lang="css" scoped>
    .top-menu-option {
        display: flex;
        align-items: center;
        margin-bottom: var(--mobile-menu-option-margin-bottom);
    }

    .top-menu-option-text {
        padding: 0;
        width: 100%;
        font-family: var(--top-menu-font);
        font-size: var(--mobile-menu-option-font-size);
        text-align: var(--mobile-menu-option-text-align);
    }
</style>