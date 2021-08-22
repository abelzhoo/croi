<?php

namespace App\Repository;

use App\Entity\Commity;
use App\Entity\Education;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commity[]    findAll()
 * @method Commity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commity::class);
    }

    public function findByEducation()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 
            "SELECT  COUNT(*) as total, DATE_FORMAT(e.date_debut, '%Y') as debut FROM `commity`as c LEFT JOIN education as e ON c.id = e.commity_id GROUP BY debut";

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAllAssociative();

        
    }

    // /**
    //  * @return Commity[] Returns an array of Commity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Commity
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
