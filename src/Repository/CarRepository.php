<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function findByFilters(array $filters): array
    {
        $qb = $this->createQueryBuilder('car');

        // Filtrer par type de carburant
        if (!empty($filters['fuel'])) {
            $qb->andWhere('car.energy = :fuel')->setParameter('fuel', $filters['fuel']);
        }

        // Filtrer par fourchette de prix
        if (!empty($filters['price'])) {
            // Si la valeur est '+70000', considérez tout ce qui est supérieur à 70000
            if ($filters['price'] === '+70000') {
                $qb->andWhere('car.price >= :minPrice')->setParameter('minPrice', 70000);
            } else {
                // Sinon, traitez les plages de prix normalement
                $priceRanges = [
                    '0-5000' => [0, 5000],
                    '5100-10000' => [5100, 10000],
                    '11000-15000' => [11000, 15000],
                    '16000-20000' => [16000, 20000],
                    '21000-25000' => [21000, 25000],
                    '26000-30000' => [26000, 30000],
                    '31000-40000' => [31000, 40000],
                    '41000-50000' => [41000, 50000],
                    '51000-60000' => [51000, 60000],
                    '61000-70000' => [61000, 70000],
                ];
    
                if (isset($priceRanges[$filters['price']])) {
                    $range = $priceRanges[$filters['price']];
                    $qb->andWhere('car.price >= :minPrice AND car.price <= :maxPrice')
                        ->setParameter('minPrice', $range[0])
                        ->setParameter('maxPrice', $range[1]);
                }
            }
        }

        // Filtrer par fourchette de kilométrage
        if (!empty($filters['kilometer'])) {
            $kilometerRanges = [
                '0-25000' => [0, 25000],
                '26000-50000' => [26000, 50000],
                '51000-75000' => [51000, 75000],
                '76000-100000' => [76000, 100000],
                '101000-125000' => [101000, 125000],
                '126000-150000' => [126000, 150000],
            ];
    
            if (isset($kilometerRanges[$filters['kilometer']])) {
                $range = $kilometerRanges[$filters['kilometer']];
                $qb->andWhere('car.kilometer >= :minKilometer AND car.kilometer <= :maxKilometer')
                    ->setParameter('minKilometer', $range[0])
                    ->setParameter('maxKilometer', $range[1]);
            }
        }

        // Filtrer par fourchette d'années
        if (!empty($filters['year'])) {
            $yearRanges = [
                '2010-2015' => [2010, 2015],
                '2016-2020' => [2016, 2020],
                '2021-2025' => [2021, 2025],
            ];
    
            if (isset($yearRanges[$filters['year']])) {
                $range = $yearRanges[$filters['year']];
                $qb->andWhere('car.year >= :minYear AND car.year <= :maxYear')
                    ->setParameter('minYear', $range[0])
                    ->setParameter('maxYear', $range[1]);
            }
        }

        return $qb->getQuery()->getResult();
    }
}
