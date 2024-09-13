<?php

namespace App\Factory;

use App\Service\CarrierService;
use Exception;
use Symfony\Bundle\MakerBundle\Str;

class CarrierServiceFactory
{
  public static function createFromSlug(string $slug): CarrierService
  {
    $class = self::getClassBySlug($slug);

    if (!class_exists($class)) {
      throw new Exception("Carrier service class '{$class}' not found.");
    }

    return new $class();
  }

  private static function getClassBySlug(string $slug): string
  {
    $className = Str::asCamelCase($slug) . 'CarrierService';

    return 'App\\Service\\Companies\\' . $className;
  }
}
