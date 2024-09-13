<?php

declare(strict_types=1);

namespace App\Service;

use App\Contract\BaseCarrierCalculatorInterface;
use App\Entity\Carrier;

class DeliveryCostService
{
  private BaseCarrierCalculatorInterface $carrierService;
  private Carrier $carrier;

  public function __construct(BaseCarrierCalculatorInterface $carrierService, Carrier $carrier)
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
