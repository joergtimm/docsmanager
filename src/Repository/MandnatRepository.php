<?php

namespace App\Repository;

use App\Entity\Mandnat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
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


    public function findBySearch(?string $query, ?string $sort = null, string $direction = 'desc'): QueryBuilder
    {
        $qb = $this->createQueryBuilder('m');

        if ($query) {
            $qb->andWhere('m.name LIKE :query')
                ->setParameter('query', '%' . $query . '%');
        }
        if ($sort) {
                $qb->orderBy('m.' . $sort, $direction);
        }

        return $qb;
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
