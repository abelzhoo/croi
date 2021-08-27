<?php

namespace App\Repository;

use App\Entity\Social;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Social|null find($id, $lockMode = null, $lockVersion = null)
 * @method Social|null findOneBy(array $criteria, array $orderBy = null)
 * @method Social[]    findAll()
 * @method Social[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SocialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Social::class);
    }

    public function findByAide()
    {
        $socials = [];
        // nourriture
        $oNouriture = $this->query('aide_nourriture', 'OUI') ;
        $nNouriture = $this->query('aide_nourriture', 'NON') ;
        $nouriture = ['oui' => $oNouriture, 'non' => $nNouriture] ;

        //education
        $oEducation = $this->query('aide_education', 'OUI') ;
        $nEducation = $this->query('aide_education', 'NON') ;
        $education = ['oui' => $oEducation, 'non' => $nEducation] ;

        //social
        $oSocial= $this->query('aide_social', 'OUI') ;
        $nSocial = $this->query('aide_social', 'NON') ;
        $social = ['oui' => $oSocial, 'non' => $nSocial] ;

        //sante
        $oSante= $this->query('aide_sante', 'OUI') ;
        $nSante = $this->query('aide_sante', 'NON') ;
        $sante = ['oui' => $oSante, 'non' => $nSante] ;

        //travail
        $oTravail= $this->query('aide_travail', 'OUI') ;
        $nTravail = $this->query('aide_travail', 'NON') ;
        $travail = ['oui' => $oTravail, 'non' => $nTravail] ;

        $socials['nourriture'] = $nouriture;
        $socials['education'] = $education;
        $socials['social'] = $social;
        $socials['sante'] = $sante;
        $socials['travail'] = $travail;

        return $socials;
    }

    private function query($fields, $value)
    {
        $conn = $this->getEntityManager()->getConnection();
        $req = "SELECT  COUNT(*) as total 
            FROM `social`as s INNER JOIN commity as c ON c.id = s.commity_id
            WHERE ". $fields ." = :var";
        $stmt = $conn->prepare($req) ;
        $stmt->execute(['var' => $value]);
        return $stmt->fetchOne();
    }
}
