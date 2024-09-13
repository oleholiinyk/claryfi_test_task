<?php

namespace App\Type;

use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use App\Enums\Currency;

class CurrencyType extends StringType
{
  const string NAME = 'currency';

  public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
  {
    return 'VARCHAR(3)';
  }

  public function convertToPHPValue($value, AbstractPlatform $platform): ?Currency
  {
    return $value !== null ? Currency::from($value) : null;
  }

  public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
  {
    return $value?->value;
  }

  public function getName(): string
  {
    return self::NAME;
  }
}
