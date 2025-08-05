<script setup>
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'

import TopMenu from '@/Components/QuestionPage/TopMenu.vue'
import HeaderTitle from '@/Components/QuestionPage/HeaderTitle.vue'
import OptionItem from '@/Components/QuestionPage/OptionButton.vue'
import SubmitButton from '@/Components/QuestionPage/SubmitButton.vue'

const questions = ref({})
const questionKeys = ref([])
const currentIndex = ref(0)
const selected = ref('')
const inputValue = ref('')
const answerFormat = ref({})
const userAnswers = ref({})
const errorMessage = ref('')

onMounted(async () => {
  const [questionsRes, formatRes] = await Promise.all([
    axios.get('/api/diabetes-test/questions'),
    axios.get('/api/diabetes-test/answers-format'),
  ])

  questions.value = questionsRes.data
  questionKeys.value = Object.keys(questions.value)
  answerFormat.value = formatRes.data
})

const currentQuestion = computed(() => {
  const key = questionKeys.value[currentIndex.value]
  return questions.value[key]
})

const hasOptions = computed(() => {
  return currentQuestion.value?.options !== undefined
})

const goToNext = () => {
  errorMessage.value = ''

  const currentKey = questionKeys.value[currentIndex.value]
  const answerKey = answerFormat.value[currentKey]
  const questionData = questions.value[currentKey]

  let finalValue = ''

  if (hasOptions.value) {
    const selectedKey = selected.value

    if (!selectedKey) {
      errorMessage.value = 'Будь ласка, виберіть відповідь перед тим, як продовжити.'
      return
    }

    finalValue = questionData.values?.[selectedKey] ?? selectedKey
  } else {
    if (!inputValue.value) {
      errorMessage.value = 'Будь ласка, введіть значення перед тим, як продовжити.'
      return
    }

    finalValue = inputValue.value
  }

  userAnswers.value[answerKey] = finalValue

  selected.value = ''
  inputValue.value = ''

  if (currentIndex.value < questionKeys.value.length - 1) {
    currentIndex.value++
  } else {
    submitQuiz()
  }
}

function submitQuiz() {
  fetch('http://127.0.0.1:8000/diabetes-test/results', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(userAnswers.value)
  })
  .then(response => response.json())
  .then(() => {
    window.location.href = '/diabetes-test/results/show'
  })
  .catch(error => {
    console.error('Error:', error)
  })
}
</script>

<template>
  <div class="page" v-if="currentQuestion">
    <TopMenu icon-url="/images/top-menu-logo.png" :text="'Питання ' + (currentIndex + 1)" />
    <HeaderTitle :text="currentQuestion.question" />

    <div class="options" v-if="hasOptions">
      <OptionItem
        v-for="(text, key) in currentQuestion.options"
        :key="key"
        :text="text"
        v-model="selected"
      />
    </div>

    <div class="flex justify-center" v-else>
      <input
        v-model="inputValue"
        :min="currentQuestion.min"
        :max="currentQuestion.max"
        type="number"
        class="border rounded p-2 w-full max-w-xs text-center"
        placeholder="Введіть відповідь"
      />
    </div>

    <p v-if="errorMessage" class="text-red-600 text-center mt-4">{{ errorMessage }}</p>

    <div class="flex justify-center mt-6">
      <SubmitButton text="Далі" @click="goToNext" />
    </div>
  </div>
</template>

<style scoped>
  .page {
    max-width: 600px;
    margin: 0 auto;
    padding: 2rem;
    font-family: var(--questions-font-family);
  }
  .options {
    display: flex;
    flex-direction: column;
  }
</style>