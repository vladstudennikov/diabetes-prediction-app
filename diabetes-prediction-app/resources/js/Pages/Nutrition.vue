<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import axios from 'axios';
import VueCal from 'vue-cal';
import NutritionControlForm from '@/Components/NutritionForm/NutritionControlForm.vue';

// Обрана дата
const selectedDate = ref(null);

// Показ модального вікна
const showMealModal = ref(false);

// Дані про прийоми їжі
const meals = ref([]);

// Обробка кліку по клітинці календаря
function onCellClick(date) {
  selectedDate.value = date;
}

// Завантаження даних про їжу при зміні дати
watch(selectedDate, async (newDate) => {
  if (!newDate) return;

  try {
    const response = await axios.get('/nutrition', {
      params: { date: newDate.toISOString().slice(0, 10) }
    });
    meals.value = response.data;
  } catch (error) {
    console.error('Помилка завантаження даних про їжу:', error);
  }
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Календар -->
                        <div>
                            <VueCal
                                style="height: 400px"
                                hide-view-selector
                                default-view="month"
                                :disable-views="['years', 'year', 'week', 'day', 'agenda']"
                                @cell-click="onCellClick"
                            />
                        </div>

                        <!-- Правий блок -->
                        <div>
                            <h2 class="text-lg font-semibold mb-4">Обрана дата:</h2>
                            <p class="mb-6">
                                {{ selectedDate ? selectedDate.toLocaleDateString('uk-UA') : 'Нічого не вибрано' }}
                            </p>

                            <h2 class="text-lg font-semibold mb-2">Раціон за сьогодні:</h2>
                            <ul v-if="meals.length" class="mb-4 text-gray-800 list-disc list-inside">
                                <li v-for="(meal, index) in meals" :key="index">
                                    <strong>{{ meal.dish_name }}:</strong> {{ meal.meal_name }}
                                </li>
                            </ul>
                            <p v-else class="mb-4 text-gray-600">Пусто</p>

                            <button @click="showMealModal = true" class="px-4 py-2 text-white rounded" style="background-color: #25786e;">
                                Додати страву
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <NutritionControlForm v-model="showMealModal" />
        </div>
    </AuthenticatedLayout>
</template>