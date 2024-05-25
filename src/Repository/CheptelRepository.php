<?php

namespace App\Repository;

use App\Entity\Cheptel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cheptel>
 *
 * @method Cheptel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cheptel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cheptel[]    findAll()
 * @method Cheptel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheptelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cheptel::class);
    }

    public function findTraitementWithNomCheptel(string $nomCheptel)
    {
        return $this->createQueryBuilder('ch')
            ->leftJoin('ch.chevres', 'c')
            ->leftJoin('c.groupetraitements', 'gt')
            ->addSelect('c', 'gt')
            ->where('ch.nomCheptel = :nomCheptel')
            ->setParameter('nomCheptel', $nomCheptel)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Cheptel[] Returns an array of Cheptel objects
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

//    public function findOneBySomeField($value): ?Cheptel
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
