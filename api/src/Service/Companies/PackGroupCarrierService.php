<?php

namespace App\Service\Companies;

use App\Interfaces\Companies\PackGroupCarrierInterface;
use App\Service\CarrierService;

class PackGroupCarrierService extends CarrierService implements PackGroupCarrierInterface
{
  private const int PRICE_PER_KG = 1;

  public function calculateCost(float $weight): float
  {
    return $weight * self::PRICE_PER_KG;
  }
}
