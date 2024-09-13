<?php

namespace App\Calculator\Carriers;

class PackGroupCarrierCalculator extends BaseCarrierCalculatorCalculator
{
  private const int PRICE_PER_KG = 1;

  public function calculateCost(float $weight): float
  {
    return $weight * self::PRICE_PER_KG;
  }
}
