<script setup>
    import { defineProps } from 'vue'
    import { router } from '@inertiajs/vue3'

    import MainTopMenuPicture from '@/Components/MainTopMenu/MainTopMenuPicture.vue'
    import MainTopMenuButton from '@/Components/MainTopMenu/MainTopMenuButton.vue'
    import MainTopMenuOption from '@/Components/MainTopMenu/MainTopMenuOption.vue'

    function logout() {
        router.post('/logout', {}, {
            onSuccess: () => {
                window.location.reload()
            }
        })
    }

    const props = defineProps({
        userLoggedIn: Boolean
    })
</script>

<template>
    <div class="main-top-menu">
        <div class="main-top-menu-picture">
            <MainTopMenuPicture imageUrl="/images/top-menu-logo.png" pageUrl="/" />
        </div>

        <div class="main-top-menu-option-list">
            <MainTopMenuOption text="Головна" pageUrl="/" />
            <MainTopMenuOption text="Про діабет" pageUrl="/about-diabetes" />
            <MainTopMenuOption text="Тест" pageUrl="/diabetes-test" />
            <MainTopMenuOption text="Про нас" pageUrl="about-us" />
        </div>

        <div class="main-top-menu-register">
            <template v-if="!userLoggedIn">
                <MainTopMenuOption text="Увійти" pageUrl="/login" />
                <MainTopMenuButton text="Реєстрація" pageUrl="/register" />
            </template>

            <template v-else>
                <MainTopMenuOption text="Вийти" @click="logout" />
                <MainTopMenuButton text="Панель" pageUrl="/dashboard" />
            </template>
        </div>
    </div>
</template>

<script></script>

<style scoped>
    .main-top-menu {
        position: relative;
        display: var(--top-menu-visibility);
        align-items: center;
        justify-content: center;
        height: var(--top-menu-height);
    }

    .main-top-menu div {
        display: flex;
        align-items: center;
    }

    .main-top-menu-picture {
        position: absolute;
        left: 0;
        padding-left: 20px;
    }

    .main-top-menu-register {
        position: absolute;
        right: 0;
        padding-right: 20px;
    }

    .main-top-menu-option-list {
        gap: var(--top-menu-options-gap);
    }
</style>