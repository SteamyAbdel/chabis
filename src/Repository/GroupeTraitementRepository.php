<?php

namespace App\Repository;

use App\Entity\GroupeTraitement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GroupeTraitement>
 *
 * @method GroupeTraitement|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupeTraitement|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupeTraitement[]    findAll()
 * @method GroupeTraitement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeTraitementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupeTraitement::class);
    }

    public function findTraitementWithMatricule(string $matricule)
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.chevres', 'c')
            ->addSelect('c')
            ->where('c.matriculeChevre = :matricule')
            ->setParameter('matricule', $matricule)
            ->getQuery()
            ->getResult();
    }


//    /**
//     * @return GroupeTraitement[] Returns an array of GroupeTraitement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GroupeTraitement
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
