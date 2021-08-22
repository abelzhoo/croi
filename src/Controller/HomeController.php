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
        /*$santesData = $santeRepository->findByDate();
        $educationData = $commity->findByEducation();
        $educations = [];
        $santes = [];

        //sante
        foreach($santesData as $value){
    
            $tab['pourcentage'] = ($value['total'] * 100) / count($commity->findAll());
            $tab['annee'] = $value['date_debut'];
            $santes[] = array_merge($tab);
        }
        //education
        foreach($educationData as $value){
            $tab['pourcentage'] = ($value['total'] * 100) / count($commity->findAll());
            $tab['annee'] = $value['debut'];
            $educations[] = array_merge($tab);
        }*/

        return $this->render("home/index.html.twig", [

        ]);
    }

}