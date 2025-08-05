<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import VueCal from 'vue-cal';
import PhysActivityForm from '@/Components/PhysActivityForm/PhysActivityForm.vue';

const selectedDate = ref(null);

const showModal = ref(false);

function onCellClick(date) {
    selectedDate.value = date;
}

const activities = ref([])

watch(selectedDate, async (newDate) => {
  if (!newDate) return

  const formatted = newDate.toISOString().split('T')[0]
  const response = await axios.get('/phys-activities', {
    params: { date: formatted }
  })

  activities.value = response.data
})

function refreshActivities() {
  selectedDate.value = new Date(selectedDate.value)
}
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

                            <h2 class="text-lg font-semibold mb-2">Ваші вправи:</h2>
                            <ul v-if="activities.length > 0" class="mb-4 text-gray-800 list-disc pl-6">
                                <li v-for="(a, index) in activities" :key="index">
                                    {{ a.activity_name }} — {{ a.duration }} хв
                                </li>
                            </ul>
                            <p v-else class="mb-4 text-gray-600">Поки що немає вправ</p>

                            <button @click="showModal = true" class="px-4 py-2 text-white rounded" style="background-color: #25786e;">
                                Додати вправу
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <PhysActivityForm v-model="showModal"></PhysActivityForm>
        </div>
    </AuthenticatedLayout>
</template>