<?php

namespace App\Repository;

use App\Entity\ActorClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ActorClient>
 *
 * @method ActorClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActorClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActorClient[]    findAll()
 * @method ActorClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActorClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActorClient::class);
    }

//    /**
//     * @return ActorClient[] Returns an array of ActorClient objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ActorClient
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
