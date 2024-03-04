<?php

namespace App\Repository;

use App\Entity\PushMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PushMessage>
 *
 * @method PushMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method PushMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method PushMessage[]    findAll()
 * @method PushMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PushMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PushMessage::class);
    }

    //    /**
    //     * @return PushMessage[] Returns an array of PushMessage objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?PushMessage
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
