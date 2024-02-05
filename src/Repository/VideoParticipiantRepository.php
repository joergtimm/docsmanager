<?php

namespace App\Repository;

use App\Entity\VideoParticipiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VideoParticipiant>
 *
 * @method VideoParticipiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method VideoParticipiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method VideoParticipiant[]    findAll()
 * @method VideoParticipiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoParticipiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VideoParticipiant::class);
    }

//    /**
//     * @return VideoParticipiant[] Returns an array of VideoParticipiant objects
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

//    public function findOneBySomeField($value): ?VideoParticipiant
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
