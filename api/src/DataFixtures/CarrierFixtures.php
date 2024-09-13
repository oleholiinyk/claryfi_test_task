<?php

namespace App\DataFixtures;

use App\Entity\Carrier;
use App\Enums\Currency;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\MakerBundle\Str;

class CarrierFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    $carriers = [
      ['name' => 'TransCompany', 'currency' => Currency::EUR],
      ['name' => 'PackGroup', 'currency' => Currency::EUR],
    ];

    foreach ($carriers as $carrierData) {
      $carrier = new Carrier();
      $carrier->setName($carrierData['name']);
      $carrier->setSlug(Str::asSnakeCase($carrierData['name']));
      $carrier->setCurrency($carrierData['currency']);

      $manager->persist($carrier);
    }

    $manager->flush();
  }
}
