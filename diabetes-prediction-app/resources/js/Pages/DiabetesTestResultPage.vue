<script setup>
    import MainPicture from '@/Components/MainPicturePart/MainPicture.vue';
    import Footer from '@/Components/Footer/Footer.vue';
    import MainTopMenu from '@/Components/MainTopMenu/MainTopMenu.vue';
    import MobileMenu from '@/Components/MobileTopMenu/MobileMenu.vue';
    import { usePage } from '@inertiajs/vue3'

    defineProps({
        header: String
    });

    const { props } = usePage()
    const isLoggedIn = props.auth && props.auth.user
</script>

<template>

    <template v-if="isLoggedIn">
        <MainTopMenu :userLoggedIn="true"></MainTopMenu>
        <MobileMenu imageUrl="/images/top-menu-logo.png" :userLoggedIn="true" />
    </template>

    <template v-else>
        <MainTopMenu :userLoggedIn="false"></MainTopMenu>
        <MobileMenu imageUrl="/images/top-menu-logo.png" :userLoggedIn="false" />
    </template>
    
    <MainPicture :header="header" 
        description="Ви можете ознайомитись з порадами по боротьбі з діабетом на нашому сайті"
        imageUrl="/images/test-main-picture.png" />

    <Footer />

</template>

<script></script>

<style scoped>
    
</style>