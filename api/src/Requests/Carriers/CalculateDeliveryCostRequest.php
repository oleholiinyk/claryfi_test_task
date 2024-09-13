<?php

declare(strict_types=1);

namespace App\Requests\Carriers;

use App\Requests\BaseRequest;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
class CalculateDeliveryCostRequest extends BaseRequest
{
  #[NotBlank(message: 'This field should not be blank.')]
  #[Type('string')]
  public readonly string $carrierSlug;

  #[NotBlank(message: 'This field should not be blank.')]
  #[Type('float')]
  public readonly float $weight;
}
