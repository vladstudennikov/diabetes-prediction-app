<template>
  <div
    v-if="modelValue"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
  >
    <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl relative">
      <h2 class="text-xl font-semibold text-gray-800 mb-4">Додати прийом їжі</h2>

      <form @submit.prevent="submitForm">
        <!-- Дата -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Дата</label>
          <input
            type="date"
            v-model="form.date"
            class="w-full border border-gray-300 rounded px-3 py-2"
            required
          />
        </div>

        <!-- Назва страви -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Страва</label>
          <input
            type="text"
            v-model="form.meal"
            class="w-full border border-gray-300 rounded px-3 py-2"
            placeholder="Наприклад: Вівсянка з фруктами"
            required
          />
        </div>

        <!-- Тип прийому їжі -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Тип прийому їжі</label>
          <select
            v-model="form.type"
            class="w-full border border-gray-300 rounded px-3 py-2"
            required
          >
            <option disabled value="">Оберіть тип</option>
            <option>Сніданок</option>
            <option>Обід</option>
            <option>Вечеря</option>
            <option>Перекус</option>
          </select>
        </div>

        <!-- Кнопки -->
        <div class="flex justify-between mt-6">
          <button
            type="submit"
            class="bg-[#25786e] text-white px-4 py-2 rounded hover:bg-[#1e6058]"
            data-cy="submit-activity"
            >
            Додати
          </button>
          <button
            type="button"
            class="text-[#25786e] border border-[#25786e] px-4 py-2 rounded hover:bg-gray-100"
            @click="resetForm"
          >
            Очистити
          </button>
        </div>
      </form>

      <!-- Закриття -->
      <button
        class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl"
        @click="$emit('update:modelValue', false)"
      >
        ×
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
  modelValue: Boolean
});

const emit = defineEmits(['update:modelValue']);

const form = ref({
  date: '',
  meal: '',
  type: ''
});

function resetForm() {
  form.value = {
    date: '',
    meal: '',
    type: ''
  };
}

function submitForm() {
  axios.post('/nutrition', {
    date: form.value.date,
    meal_name: form.value.meal,
    dish_name: form.value.type
  })
  .then(response => {
    alert(response.data.message);
    resetForm();
    emit('update:modelValue', false);
  })
  .catch(error => {
    alert('Помилка при додаванні: ' + error.response?.data?.message ?? 'Невідома помилка')
    console.error(error);
  });
}
</script>