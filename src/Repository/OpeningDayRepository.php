<?php

namespace App\Repository;

use App\Entity\OpeningDay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OpeningDay>
 *
 * @method OpeningDay|null find($id, $lockMode = null, $lockVersion = null)
 * @method OpeningDay|null findOneBy(array $criteria, array $orderBy = null)
 * @method OpeningDay[]    findAll()
 * @method OpeningDay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpeningDayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OpeningDay::class);
    }

//    /**
//     * @return OpeningDay[] Returns an array of OpeningDay objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OpeningDay
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
