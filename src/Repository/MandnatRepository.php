<?php

namespace App\Repository;

use App\Entity\Mandnat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mandnat>
 *
 * @method Mandnat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mandnat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mandnat[]    findAll()
 * @method Mandnat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MandnatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mandnat::class);
    }

//    /**
//     * @return Mandnat[] Returns an array of Mandnat objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Mandnat
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
