<?php

namespace App\Repository;

use App\Entity\HistoricalData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HistoricalData|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoricalData|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoricalData[]    findAll()
 * @method HistoricalData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoricalDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoricalData::class);
    }

    // /**
    //  * @return HistoricalData[] Returns an array of HistoricalData objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HistoricalData
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
