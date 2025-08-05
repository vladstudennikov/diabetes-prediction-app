<template>
  <div class="option">
    <input
      type="radio"
      :id="text"
      name="option"
      :value="text"
      :checked="modelValue === text"
      @change="$emit('update:modelValue', text)"
    />
    <label :for="text">{{ text }}</label>
  </div>
</template>

<script setup>
    const props = defineProps({
    text: String,
    modelValue: String
    })

    const emit = defineEmits(['update:modelValue'])
</script>

<style scoped>
    .option {
    display: flex;
    align-items: center;
    margin: 0.5rem 0;
    }
    .option input[type="radio"] {
    margin-right: 0.5rem;
    }
    label {
    font-size: var(--font-base);
    color: var(--color-text);
    }
</style>