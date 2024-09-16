<?php

namespace App\Calculator\Carriers;

class TransCompanyCarrierCalculator extends BaseCarrierCalculator
{
  private const int PRICE_BELOW = 20;
  private const int PRICE_ABOVE = 100;
  private const int WEIGHT_THRESHOLD = 10;

  public function calculateCost(float $weight): float
  {
    if ($weight <= self::WEIGHT_THRESHOLD) {
      return self::PRICE_BELOW;
    }

    return self::PRICE_ABOVE;
  }
}
