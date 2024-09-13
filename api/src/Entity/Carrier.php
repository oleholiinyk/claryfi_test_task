<?php

namespace App\Entity;

use App\Enums\Currency;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="carriers")
 */
class Carrier
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private int $id;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private string $name;

  /**
   * @ORM\Column(type="string", length=255, unique=true)
   */
  private string $slug;

  /**
   * @ORM\Column(type="currency")
   */
  private Currency $currency;

  // Getters and setters
  public function getId(): int
  {
    return $this->id;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getSlug(): string
  {
    return $this->slug;
  }

  public function setSlug(string $slug): self
  {
    $this->slug = $slug;

    return $this;
  }

  public function getCurrency(): Currency
  {
    return $this->currency;
  }

  public function setCurrency(Currency $currency): self
  {
    $this->currency = $currency;

    return $this;
  }
}
