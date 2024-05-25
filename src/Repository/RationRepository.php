<?php

namespace App\Repository;

use App\Entity\Ration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ration>
 *
 * @method Ration|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ration|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ration[]    findAll()
 * @method Ration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ration::class);
    }

//    /**
//     * @return Ration[] Returns an array of Ration objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ration
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
