<?php

namespace App\Interfaces;

interface CarrierInterface
{
  /**
   * @param float $weight
   * @return float
   */
  public function calculateCost(float $weight): float;
}
