<script setup>
    import { ref } from 'vue'
    import MobileMenuOption from './MobileMenuOption.vue'
    import MobileMenuButton from './MobileMenuButton.vue'

    defineProps({ 
        imageUrl: String,
        userLoggedIn: Boolean
    })

    const isOpen = ref(false)
    const toggleMenu = () => {
        isOpen.value = !isOpen.value;
    }

    function logout() {
        router.post('/logout', {}, {
            onSuccess: () => {
                window.location.reload()
            }
        })
    }
</script>

<template>
  <div class="mobile-header">
    <div class="mobile-header__inner">
      <div class="mobile-header__logo">
        <img :src="imageUrl" alt="Logo">
      </div>

      <button class="mobile-header__toggle" @click="toggleMenu">
        <span :class="{ open: isOpen }"></span>
        <span :class="{ open: isOpen }"></span>
        <span :class="{ open: isOpen }"></span>
      </button>
    </div>

    <transition name="slide">
      <nav v-if="isOpen" class="mobile-menu flex flex-col h-screen">
        <div class="flex flex-col flex-grow">
          <MobileMenuOption pageUrl="/" text="Головна" />
          <MobileMenuOption text="Про діабет" pageUrl="/about-diabetes" />
          <MobileMenuOption text="Тест" pageUrl="/test" />
          <MobileMenuOption text="Про нас" pageUrl="/about-us" />
        </div>
        
        <div class="flex items-center justify-center mb-4">
          <template v-if="! userLoggedIn">
            <MobileMenuOption class="mx-6" text="Увійти" pageUrl="/login" />
            <MobileMenuButton text="Реєстрація" pageUrl="/register" />
          </template>

          <template v-else>
            <MobileMenuOption class="mx-6" text="Вийти" @click="logout" />
            <MobileMenuButton class="mx-6" text="Профіль" pageUrl="/dashboard" />
          </template>
        </div>

        <slot name="menu"></slot>
      </nav>
    </transition>
  </div>
</template>

<style scoped>

.mobile-header {
  display: none;
}

@media (max-width: 768px) {
  .mobile-header {
    display: block;
    position: relative;
    background-color: var(--mobile-bg-color);
    height: var(--mobile-header-height);
    z-index: 1000;
  }

  .mobile-header__inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 1rem;
    height: 100%;
  }

  .mobile-header__logo {
    font-size: 1.2rem;
    font-weight: bold;
    color: var(--mobile-text-color);
  }

  .mobile-header__logo img {
    width: var(--mobile-logo-width);
    height: var(--mobile-logo-height);
  } 

  .mobile-header__toggle {
    position: relative;
    width: var(--hamburger-line-width);
    height: calc((var(--hamburger-line-height) * 3) + (var(--hamburger-line-gap) * 2));
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
  }

  .mobile-header__toggle span {
    position: absolute;
    left: 0;
    width: 100%;
    height: var(--hamburger-line-height);
    background-color: var(--mobile-text-color);
    transition: transform 0.3s ease, opacity 0.3s ease;
  }

  /* Position lines */
  .mobile-header__toggle span:nth-child(1) {
    top: 0;
  }

  .mobile-header__toggle span:nth-child(2) {
    top: calc(var(--hamburger-line-height) + var(--hamburger-line-gap));
  }

  .mobile-header__toggle span:nth-child(3) {
    top: calc((var(--hamburger-line-height) + var(--hamburger-line-gap)) * 2);
  }

  /* Transform on open */
  .mobile-header__toggle span.open:nth-child(1) {
    transform: rotate(45deg);
    top: calc(var(--hamburger-line-height) + var(--hamburger-line-gap));
  }

  .mobile-header__toggle span.open:nth-child(2) {
    opacity: 0;
  }

  .mobile-header__toggle span.open:nth-child(3) {
    transform: rotate(-45deg);
    top: calc(var(--hamburger-line-height) + var(--hamburger-line-gap));
  }

  .slide-enter-active,
  .slide-leave-active {
    transition: transform var(--menu-slide-duration) ease, opacity var(--menu-slide-duration) ease;
  }

  .slide-enter-from,
  .slide-leave-to {
    transform: translateX(100%);
    opacity: 0;
  }

  .slide-enter-to,
  .slide-leave-from {
    transform: translateX(0);
    opacity: 1;
  }

  .mobile-menu {
    position: absolute;
    top: var(--mobile-header-height);
    right: 0;
    width: 100%;
    height: 100%;
    height: calc(100vh - var(--mobile-header-height));
    background-color: var(--mobile-menu-bg);
    box-shadow: -2px 0 6px rgba(0, 0, 0, 0.1);
    padding: 1rem;
    overflow-y: auto;
  }
}
</style>