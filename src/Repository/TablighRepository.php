<?php

namespace App\Repository;

use App\Entity\Tabligh;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tabligh|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tabligh|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tabligh[]    findAll()
 * @method Tabligh[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TablighRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tabligh::class);
    }

    // /**
    //  * @return Tabligh[] Returns an array of Tabligh objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tabligh
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
