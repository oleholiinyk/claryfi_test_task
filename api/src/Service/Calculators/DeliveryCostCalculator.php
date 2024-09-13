<?php

declare(strict_types=1);

namespace App\Service\Calculators;

use App\Entity\Carrier;
use App\Service\CarrierService;

class DeliveryCostCalculator
{
  private CarrierService $carrierService;
  private Carrier $carrier;

  public function __construct(CarrierService $carrierService, Carrier $carrier)
  {
    $this->carrierService = $carrierService;
    $this->carrier = $carrier;
  }

  public function calculate(float $weight): array
  {
    $cost = $this->carrierService->calculateCost($weight);
    $currency = $this->carrier->getCurrency()->value;

    return [
      'cost' => $cost,
      'currency' => $currency,
    ];
  }
}
