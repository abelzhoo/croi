<?php

namespace App\Controller;

use App\Entity\Sante;
use App\Repository\SanteRepository;
use App\Repository\CommityRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/admin/accueil", name="app_dashboard_home")
     */
    public function index(SanteRepository $santeRepository, CommityRepository $commity): Response
    {
        $santesData = $santeRepository->findByDate();

        $santes = [];

        //sante
        foreach($santesData as $value){
    
            $tab['pourcentage'] = ($value['total'] * 100) / count($commity->findAll());
            $tab['annee'] = $value['date_debut'];
            $santes[] = array_merge($tab);
        }


        //education
        $educationData = $commity->findByEducation();
        $total_commity = count($commity->findAll());
        $etudiants = [];
        $non_etudiants = [];

        foreach($educationData as $value){
            $tab['pourcentage'] = ($value['total'] * 100) / $total_commity;
            $tab['annee'] = $value['debut'];
            array_push($etudiants, [$tab['annee'], $tab['pourcentage']]);
            array_push($non_etudiants, [$tab['annee'], 100-$tab['pourcentage']]);
        }

        return $this->render("home/index.html.twig", compact('etudiants', 'non_etudiants', 'total_commity'));
    }

}