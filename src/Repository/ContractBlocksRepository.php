<?php

namespace App\Repository;

use App\Entity\ContractBlocks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContractBlocks>
 *
 * @method ContractBlocks|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContractBlocks|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContractBlocks[]    findAll()
 * @method ContractBlocks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContractBlocksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContractBlocks::class);
    }

//    /**
//     * @return ContractBlocks[] Returns an array of ContractBlocks objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ContractBlocks
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
