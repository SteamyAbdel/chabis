<?php

namespace App\Repository;

use App\Entity\Elevage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Elevage>
 *
 * @method Elevage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Elevage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Elevage[]    findAll()
 * @method Elevage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElevageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Elevage::class);
    }

//    /**
//     * @return Elevage[] Returns an array of Elevage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Elevage
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
