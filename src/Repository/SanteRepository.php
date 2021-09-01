<?php

namespace App\Repository;

use App\Entity\Sante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sante|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sante|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sante[]    findAll()
 * @method Sante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sante::class);
    }

    public function findByDate()
    {
        $conn = $this->getEntityManager()->getConnection();
        $date_debut_min = "SELECT DATE_FORMAT( MIN(date_debut), '%Y') as date_min from sante; ";
        $date_fin_max = "SELECT DATE_FORMAT( MAX(date_fin), '%Y') as date_max from sante;";

        $date_min = $conn->prepare($date_debut_min);
        $date_max = $conn->prepare($date_fin_max);
        $date_min->execute();
        $date_max->execute();
        $date_min = $date_min->fetchOne();
        $date_max = $date_max->fetchOne();

        $sql = "SELECT COUNT(*) as total FROM sante 
                INNER JOIN commity on commity.id = sante.commity_id
                WHERE type_maladie LIKE :maladie AND :annee 
                BETWEEN DATE_FORMAT(date_debut , '%Y') AND DATE_FORMAT(date_fin , '%Y')";

        $stmt = $conn->prepare($sql);
        $santes = [];
        $maladies = ['cancer', 'orl', 'diabete', 'pulmonie', 'digestif', 'cardio', 'osetarticulation', 'genitaux', 'metabolique', 'oculaire', 'peau'] ;
        $count_maladies = count($maladies);



            for ($date_min; $date_min <= $date_max; $date_min++){
                for ($i = 0 ; $i < $count_maladies; $i++){
                    $stmt->execute(['maladie' => '%'.$maladies[$i].'%', 'annee' => $date_min]);
                    array_push( $santes, [
                        "maladie" =>$maladies[$i],
                        "annee" => $date_min,
                        "total" => $stmt->fetchOne()
                    ]);
                }
            }
            return $santes ;
    }

    // /**
    //  * @return Sante[] Returns an array of Sante objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sante
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
