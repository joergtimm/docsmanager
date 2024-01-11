<?php

namespace App\Repository;

use App\Entity\VideoActors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VideoActors>
 *
 * @method VideoActors|null find($id, $lockMode = null, $lockVersion = null)
 * @method VideoActors|null findOneBy(array $criteria, array $orderBy = null)
 * @method VideoActors[]    findAll()
 * @method VideoActors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoActorsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VideoActors::class);
    }

//    /**
//     * @return VideoActors[] Returns an array of VideoActors objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VideoActors
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
