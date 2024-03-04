<?php

namespace App\Repository;

use App\Entity\MessageSendLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MessageSendLog>
 *
 * @method MessageSendLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method MessageSendLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method MessageSendLog[]    findAll()
 * @method MessageSendLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageSendLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MessageSendLog::class);
    }

    //    /**
    //     * @return MessageSendLog[] Returns an array of MessageSendLog objects
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

    //    public function findOneBySomeField($value): ?MessageSendLog
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
