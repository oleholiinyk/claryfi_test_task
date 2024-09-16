<script setup lang="ts">
import { defineProps, defineEmits, computed } from 'vue'
import type { CalculationResponse } from '@/types/CalculationResponse'

interface Props {
  isDialogOpened: boolean,
  result: CalculationResponse|null
}

interface Emit {
  (e: 'update:isDialogOpened', value: boolean): void
}

const props = defineProps<Props>()
const emit = defineEmits<Emit>()

const isDialogOpen = computed({
  get() {
    return props.isDialogOpened
  },
  set(value) {
    emit('update:isDialogOpened', value)
  }
})

const closeDialog = () => {
  isDialogOpen.value = false
}
</script>

<template>
  <VDialog v-model="isDialogOpen" max-width="500px">
    <VCard>
      <VCardTitle>Calculation Result</VCardTitle>
      <VCardText>
        {{result?.cost}} {{result?.currency}}
      </VCardText>
      <VCardActions>
        <VBtn @click="closeDialog">Close</VBtn>
      </VCardActions>
    </VCard>
  </VDialog>
</template>
