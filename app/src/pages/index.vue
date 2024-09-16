<script setup lang="ts">
import { requiredValidator } from '@/utils/validators'
import { onMounted, ref } from 'vue'
import type { Carrier } from '@/types/Carrier'
import { useCarriersStore } from '@/stores/useCarriersStore'
import type { CalculationResponse } from '@/types/CalculationResponse'
import CalcResultDialog from '@/views/CalcResultDialog.vue'
import type { VForm } from 'vuetify/components'
import { useToast } from 'vue-toastification'

const refVForm = ref<VForm>()
const dataForm = ref<CalculateForm>({
  weight: null,
  carrier_slug: null
})

const storage = useCarriersStore()
const toast = useToast()

const carriers = ref<Carrier[]>()
const calcResult = ref<CalculationResponse | null>(null)
const isCalcResultDialogOpen = ref(false)

const fetchList = async () => {
  carriers.value = await storage.fetchList()
}

onMounted(() => {
  fetchList()
})

const onFormSubmit = async () => {
  refVForm.value?.validate()
    .then(async ({ valid: isValid }) => {
      if (isValid) {
        calcResult.value = await storage.calculate(dataForm.value)
        isCalcResultDialogOpen.value = true
        toast.success('Calculation was successful')
      } else {
        toast.error('Form is not valid')
      }
    })
}
</script>

<template>
  <VContainer>
      <VCardItem class="pb-8 justify-center">
        <h4 class="text-h4 mb-1">
          Calculate Price
        </h4>
      </VCardItem>
      <VCardText>
        <VSheet class="mx-auto" width="500">
          <VForm ref="refVForm" @submit.prevent="onFormSubmit">
            <VTextField
              v-model="dataForm.weight"
              :rules="[requiredValidator]"
              label="Package Weight (kg):"
              type="number"
              step="any"
            />

            <VSelect
              v-model="dataForm.carrier_slug"
              :items="carriers"
              item-title="name"
              item-value="slug"
              :rules="[requiredValidator]"
              label="Select carrier"
              required
            />

            <VBtn class="mt-2" type="submit" block>Calculate Price</VBtn>
          </VForm>
          <CalcResultDialog
            v-model:is-dialog-opened="isCalcResultDialogOpen"
            :visible="isCalcResultDialogOpen"
            :result="calcResult"
          />
        </VSheet>
      </VCardText>
  </VContainer>
</template>
