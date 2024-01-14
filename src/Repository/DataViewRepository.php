<?php

namespace App\Repository;

use App\Entity\DataView;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DataView>
 *
 * @method DataView|null find($id, $lockMode = null, $lockVersion = null)
 * @method DataView|null findOneBy(array $criteria, array $orderBy = null)
 * @method DataView[]    findAll()
 * @method DataView[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DataViewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DataView::class);
    }

//    /**
//     * @return DataView[] Returns an array of DataView objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DataView
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
