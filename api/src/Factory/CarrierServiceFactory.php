<?php

namespace App\Factory;

use App\Calculator\Carriers\BaseCarrierCalculatorCalculator;
use Exception;
use Symfony\Bundle\MakerBundle\Str;

class CarrierServiceFactory
{
  public static function createFromSlug(string $slug): BaseCarrierCalculatorCalculator
  {
    $class = self::getClassBySlug($slug);

    if (!class_exists($class)) {
      throw new Exception("Carrier service class '{$class}' not found.");
    }

    return new $class();
  }

  private static function getClassBySlug(string $slug): string
  {
    $className = Str::asCamelCase($slug) . 'CarrierCalculator';

    return 'App\\Calculator\\Carriers\\' . $className;
  }
}
