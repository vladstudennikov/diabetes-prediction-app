<script setup>
    import MainHeader from '@/Components/MainHeader.vue'

    defineProps({
        header: String,
        description: String,
        imageUrl: String,
    })
</script>

<template>
    <div class="main-picture px-5 flex flex-wrap items-center">
        <div class="w-full md:w-1/2 flex flex-col justify-center order-2 md:order-1 pl-10">
            <MainHeader :text="header" 
                        :classes="'text-center md:text-left text-2xl md:text-4xl'" />
            <p class="text-center md:text-left">{{ description }}</p>

            <slot></slot>
        </div>

        <div class="w-full md:w-1/2 flex items-center justify-center order-1 md:order-2">
            <img :src="imageUrl" 
                  class="w-5/8 md:w-7/10">
        </div>
    </div>
</template>

<script></script>

<style scoped>
    .main-picture {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    p {
        font-family: "Montserrat", system-ui, sans-serif;
        font-size: 18px;
        padding: 0;
    }
</style>