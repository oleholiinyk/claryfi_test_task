<?php

namespace App\Calculator\Carriers;

use App\Contract\BaseCarrierCalculatorInterface;

abstract class BaseCarrierCalculator implements BaseCarrierCalculatorInterface
{
  /**
   * method for calculating shipping costs.
   * @param float $weight Weight of the parcel
   * @return float Shipping cost
   */
  abstract public function calculateCost(float $weight): float;
}
