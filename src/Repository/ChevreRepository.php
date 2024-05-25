<?php

namespace App\Repository;

use App\Entity\Chevre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Chevre>
 *
 * @method Chevre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chevre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chevre[]    findAll()
 * @method Chevre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChevreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chevre::class);
    }

//    /**
//     * @return Chevre[] Returns an array of Chevre objects
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

//    public function findOneBySomeField($value): ?Chevre
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
