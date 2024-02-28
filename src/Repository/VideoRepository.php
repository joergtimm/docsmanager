<?php

namespace App\Repository;

use App\Entity\Client;
use App\Entity\Video;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Video>
 *
 * @method Video|null find($id, $lockMode = null, $lockVersion = null)
 * @method Video|null findOneBy(array $criteria, array $orderBy = null)
 * @method Video[]    findAll()
 * @method Video[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Video::class);
    }

    public function findBySearch(
        ?Client $client = null,
        ?string $query = null,
        ?string $sort = null,
        string $direction = 'desc'
    ): QueryBuilder {
        $qb = $this->createQueryBuilder('v');

        $qb->leftJoin('v.videoActors', 'va')
                ->leftJoin('va.actor', 'a')
                ->addSelect('va', 'a');

        if ($client) {
            $qb->andWhere('v.owner = :client')
                ->setParameter('client', $client);
        }

        if ($query) {
            $qb->andWhere('v.title LIKE :query')
                ->setParameter('query', '%' . $query . '%');
        }
        if ($sort) {
            $qb->orderBy('v.' . $sort, $direction);
        }

        return $qb;
    }


    /**
     * @throws NonUniqueResultException
     */
    public function findByVideoKey(?string $value = null)
    {
        return $this->createQueryBuilder('v')
           ->andWhere('v.v.videoKey = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

//    public function findOneBySomeField($value): ?Video
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
