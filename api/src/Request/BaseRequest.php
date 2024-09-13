<?php

namespace App\Request;

use Symfony\Bundle\MakerBundle\Str;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseRequest
{
  public function __construct(protected ValidatorInterface $validator)
  {
    $this->populate();

    if ($this->autoValidateRequest()) {
      $this->validate();
    }
  }

  public function validate(): void
  {
    $violations = $this->validator->validate($this);
    if (count($violations) < 1) {
      return;
    }

    $errors = [];

    /** @var \Symfony\Component\Validator\ConstraintViolation */
    foreach ($violations as $violation) {
      $attribute = self::snakeCase($violation->getPropertyPath());
      $errors[] = [
        'property' => $attribute,
        'value' => $violation->getInvalidValue(),
        'message' => $violation->getMessage(),
      ];
    }

    $response = new JsonResponse(['errors' => $errors], 400);
    $response->send();
    exit;
  }

  public function getRequest(): Request
  {
    return Request::createFromGlobals();
  }

  protected function populate(): void
  {
    $requestData = $this->getRequest()->toArray();
    $reflection = new \ReflectionClass($this);

    foreach ($requestData as $property => $value) {
      $attribute = lcfirst(self::camelCase($property));

      if (property_exists($this, $attribute)) {
        $reflectionProperty = $reflection->getProperty($attribute);
        $reflectionProperty->setValue($this, $value);
      }
    }
  }

  private static function camelCase(string $attribute): string
  {
    return Str::asCamelCase($attribute);
  }

  private static function snakeCase(string $attribute): string
  {
    return Str::asSnakeCase($attribute);
  }

  protected function autoValidateRequest(): bool
  {
    return true;
  }
}
