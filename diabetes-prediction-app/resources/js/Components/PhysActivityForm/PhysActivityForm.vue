<script setup>
import { ref } from 'vue'
import axios from 'axios'

const props = defineProps({
  modelValue: Boolean
})

const emit = defineEmits(['update:modelValue', 'refresh'])

const form = ref({
  date: '',
  duration: '',
  exercise: ''
})

function resetForm() {
  form.value = {
    date: '',
    duration: '',
    exercise: ''
  }
}

async function submitForm() {
  try {
    await axios.post('/phys-activities', {
      date: form.value.date,
      duration: form.value.duration,
      activity_name: form.value.exercise
    })

    alert('Вправа успішно додана!')
    emit('refresh')
    resetForm()
    emit('update:modelValue', false)
  } catch (err) {
    alert('Помилка при додаванні: ' + err.response?.data?.message ?? 'Невідома помилка')
  }
}
</script>

<!-- components/AddExerciseModal.vue -->
<template>
  <div
    v-if="modelValue"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
  >
    <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl relative">
      <h2 class="text-xl font-semibold text-gray-800 mb-4">Додати фізичну активність</h2>

      <form @submit.prevent="submitForm">
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Дата</label>
          <input
            type="date"
            v-model="form.date"
            class="w-full border border-gray-300 rounded px-3 py-2"
            required
          />
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Тривалість (хв)</label>
          <input
            type="number"
            v-model="form.duration"
            class="w-full border border-gray-300 rounded px-3 py-2"
            min="1"
            required
          />
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Назва вправи</label>
          <input
            type="text"
            v-model="form.exercise"
            class="w-full border border-gray-300 rounded px-3 py-2"
            required
          />
        </div>

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

      <button
        class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl"
        @click="$emit('update:modelValue', false)"
      >
        ×
      </button>
    </div>
  </div>
</template>