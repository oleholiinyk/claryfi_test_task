<?php

namespace App\Service;

use App\Interfaces\CarrierInterface;

abstract class CarrierService implements CarrierInterface
{
  /**
   * method for calculating shipping costs.
   * @param float $weight Weight of the parcel
   * @return float Shipping cost
   */
  abstract public function calculateCost(float $weight): float;
}
