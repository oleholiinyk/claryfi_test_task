<?php

namespace App\Contract;

interface BaseCarrierCalculatorInterface
{
  /**
   * @param float $weight
   * @return float
   */
  public function calculateCost(float $weight): float;
}
