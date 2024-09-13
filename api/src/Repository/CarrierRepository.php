<?php

namespace App\Repository;

use App\Entity\Carrier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CarrierRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Carrier::class);
  }

  public function findOneBySlug(string $slug): ?Carrier
  {
    return $this->findOneBy(['slug' => $slug]);
  }
}
