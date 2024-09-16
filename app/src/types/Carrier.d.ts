import type { Currency } from '@/types/Currency'

export interface Carrier {
  id: number;
  name: string;
  slug: string;
  currency: Currency;
}
