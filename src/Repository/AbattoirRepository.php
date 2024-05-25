<?php

namespace App\Repository;

use App\Entity\Abattoir;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Abattoir>
 *
 * @method Abattoir|null find($id, $lockMode = null, $lockVersion = null)
 * @method Abattoir|null findOneBy(array $criteria, array $orderBy = null)
 * @method Abattoir[]    findAll()
 * @method Abattoir[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AbattoirRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Abattoir::class);
    }

//    /**
//     * @return Abattoir[] Returns an array of Abattoir objects
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

//    public function findOneBySomeField($value): ?Abattoir
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
