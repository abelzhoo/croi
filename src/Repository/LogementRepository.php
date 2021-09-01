<?php

namespace App\Repository;

use App\Entity\Logement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Logement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Logement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Logement[]    findAll()
 * @method Logement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogementRepository extends ServiceEntityRepository
{
    private $connexion;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $em)
    {
        parent::__construct($registry, Logement::class);
        $this->connexion = $this->getEntityManager()->getConnection();;
    }

    public function findByOwner(){
        $sql = "SELECT  COUNT(*) as total 
            FROM `logement`as l INNER JOIN commity as c ON c.id = l.commity_id
            WHERE proprietaire = :condition GROUP  BY adresse_permanente";

        $stmt = $this->connexion->prepare($sql);
        $stmt->execute(['condition' => 'OUI']);
        $owner =  $stmt->fetchOne();
        $stmt->execute(['condition' => 'NON']);
        $locataire =  $stmt->fetchOne();
        return ['proprietaire' => $owner, 'locataire' => $locataire];
    }

    public function findByMaxAge($region)
    {
        $masculin = "SELECT COUNT(*) as total, COUNT(c.sexe) as gens FROM `logement` as l INNER JOIN `commity` as c ON l.commity_id = c.id 
        WHERE l.region = :region AND (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(date_naissance, '%Y')) > 18 AND c.sexe = 'MASCULIN'";

        $feminin = "SELECT COUNT(*) as total, COUNT(c.sexe) as gens FROM `logement` as l INNER JOIN `commity` as c ON l.commity_id = c.id 
        WHERE l.region = :region AND (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(date_naissance, '%Y')) > 18 AND c.sexe = 'FEMININ'";

        $mineur = "SELECT COUNT(*) as total, COUNT(c.sexe) as gens FROM `logement` as l INNER JOIN `commity` as c ON l.commity_id = c.id 
        WHERE l.region = :region AND (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(date_naissance, '%Y')) < 18 AND (c.sexe = 'MASCULIN' OR c.sexe = 'FEMININ')";

        $stmt1 = $this->connexion->prepare($masculin);
        $stmt2 = $this->connexion->prepare($feminin);
        $stmt3 = $this->connexion->prepare($mineur);

        $stmt1->execute(['region' => $region]);
        $stmt2->execute(['region' => $region]);
        $stmt3->execute(['region' => $region]);

        $masculins = $stmt1->fetchOne();
        $feminins = $stmt2->fetchOne();
        $mineurs = $stmt3->fetchOne();

        return  ['masculin' => $masculins, 'feminin' => $feminins, 'mineur' => $mineurs];
    }

    /*

    public function findByProvince($value){
        return $this->createQueryBuilder('l')
                    ->where('l.province = :val')
                    ->setParameter('val', $value)
                    ->getQuery()
                    ->getResult();
    }*/

    public function findByProvinces($value)
    {
        return $this->createQueryBuilder('l')
                    ->select('COUNT(l.sexe)')
                    ->andWhere('l.lieuNaissance =:val')
                    ->setParameter('val', $value)
                    ->getQuery()
                    ->getResult();
    }

    // /**
    //  * @return Logement[] Returns an array of Logement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Logement
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
