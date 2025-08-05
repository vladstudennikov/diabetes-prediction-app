<template>
    <footer class="app-footer">
      <p class="footer-label">Made by</p>
      <p class="footer-author">Studennykov Vladyslav</p>
      <p class="footer-email">
        <span class="icon"><img src="/images/email-icon.svg" alt="Email icon"></span>
        <span>7373483@stud.kai.edu.ua</span>
      </p>
    </footer>
  </template>
  
<script setup>
  
</script>
  
<style scoped>  
  .app-footer {
    background-color: var(--footer-bg);
    color: var(--footer-text-color);
    text-align: center;
    font-family: var(--footer-font-family);
    font-size: var(--footer-font-size);
    padding: var(--footer-padding);
    margin-top: var(--footer-margin-top);
  }

  .app-footer p, .app-footer span {
    font-family: var(--footer-font);
  }
  
  .footer-label {
    margin-bottom: var(--footer-spacing);
    opacity: 0.85;
  }
  
  .footer-author {
    font-weight: var(--footer-author-weight);
    margin-bottom: var(--footer-spacing);
  }
  
  .footer-email {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.3rem;
  }
  
  .footer-email .icon {
    font-size: var(--footer-icon-size);
  }
  </style>