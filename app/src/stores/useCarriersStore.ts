import { defineStore } from 'pinia'
import axiosIns from '@axios'
import type { Carrier } from '@/types/Carrier'
import type { CalculationResponse } from '@/types/CalculationResponse'

export const useCarriersStore = defineStore('carriersStore', {
  actions: {
    async fetchList(): Promise<Carrier[]> {
      return (await axiosIns.get('/carriers')).data
    },
    async calculate(data: CalculateForm): Promise<CalculationResponse> {
      return (await axiosIns.post('/carriers/calculate/delivery-cost', data)).data
    }
  }
})
