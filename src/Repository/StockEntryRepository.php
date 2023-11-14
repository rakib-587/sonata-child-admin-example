<?php

namespace App\Repository;

use App\Entity\StockEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StockEntry>
 *
 * @method StockEntry|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockEntry|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockEntry[]    findAll()
 * @method StockEntry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockEntry::class);
    }

//    /**
//     * @return StockEntry[] Returns an array of StockEntry objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StockEntry
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
