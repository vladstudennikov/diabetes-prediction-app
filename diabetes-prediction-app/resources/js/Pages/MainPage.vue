<script setup>
    import { usePage } from '@inertiajs/vue3'

    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import MainPicture from '@/Components/MainPicturePart/MainPicture.vue';
    import CardsGroup from '@/Components/Cards/CardsGroup.vue';
    import Footer from '@/Components/Footer/Footer.vue';
    import MainTopMenu from '@/Components/MainTopMenu/MainTopMenu.vue';
    import MobileMenu from '@/Components/MobileTopMenu/MobileMenu.vue';

    const { props } = usePage()
    const isLoggedIn = props.auth && props.auth.user

    const cardData = [
        {
            icon: '/images/mainpage-card-test.png',
            title: 'Тест на ризик діабету',
            description: 'Тест, побудований на основі штучного інтелекту, допоможе визначити ризик виникнення цукрового діабету.',
            buttonText: 'Пройти тест',
            buttonUrl: '/diabetes-test'
        },
        {
            icon: '/images/mainpage-card-nutrition.png',
            title: 'Контроль харчування',
            description: 'Записуйте інформацію про те, що їсте, і отримуйте поради щодо покращення раціону для попередження діабету.',
            buttonText: 'Розпочати',
            buttonUrl: '/nutrition'
        },
        {
            icon: '/images/mainpage-card-phys-activity.png',
            title: 'Контроль активності',
            description: 'Фіксуйте фізичну активність за день та переглядайте вашу статистику згодом, а також отримуйте персоналізовані рекомендації.',
            buttonText: 'Розпочати',
            buttonUrl: '/phys-activity'
        }
    ];
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
    
    <MainPicture header="Діабет можна попередити"
        description="І цей сервіс допоможе Вам в цьому!"
        imageUrl="/images/mainpage-main-image.png"
        addButton="false" />

    <h1 style="font-family: var('--main-header-font');
        font-weight: var(--main-header-weight);
        color: var(--main-header-color);"
            
        class="hidden md:block text-2xl text-end px-10 pt-8">
            Що ми пропонуємо
    </h1>

    <CardsGroup :cards="cardData" />
    <Footer />

</template>

<script></script>

<style scoped>
    
</style>