<script setup>
    import Card from './Card.vue';

    defineProps({
        cards: {
            type: Array,
            required: true
        }
    })
</script>

<template>
    <div class="w-full px-4 py-8">
        <div class="max-w-4xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <Card
                v-for="(card) in cards"
                :icon="card.icon"
                :title="card.title"
                :description="card.description"
                :buttonText="card.buttonText"
                :buttonUrl="card.buttonUrl"
            />
        </div>
    </div>
</template>

<style lang="css" scoped>
    
</style>