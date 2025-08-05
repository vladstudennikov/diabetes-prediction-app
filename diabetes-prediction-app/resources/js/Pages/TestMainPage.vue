<script setup>
    import MainTopMenu from '@/Components/MainTopMenu/MainTopMenu.vue'
    import MainPicture from '@/Components/MainPicturePart/MainPicture.vue'
    import MobileMenu from '@/Components/MobileTopMenu/MobileMenu.vue'
    import Footer from '@/Components/Footer/Footer.vue'

    import { usePage } from '@inertiajs/vue3'
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
    
    <MainPicture header="Тест на визначення діабету"
        description="Алгоритм машинного навчання допоможе Вам дізнатись, яким є ризик виникнення цукрового діабету 2 типу та як скоригувати Ваш стиль життя для зменшення цього ризику."
        imageUrl="/images/test-main-picture.png"
        addButton="true" buttonText="Пройти тест" buttonLink="/diabetes-test/start">

        <a href="/diabetes-test/start">
            <p class="main-picture-button">
                Пройти тест
            </p>
        </a>
    </MainPicture>
    
    <Footer />
</template>

<style lang="css" scoped>
    .main-picture-button {
        background-color: var(--main-image-button-color);
        color: var(--main-image-button-text-color);
        width: fit-content;
        padding: 10px 30px;
        margin-top: 20px;
        border-radius: 20px;
    }
</style>