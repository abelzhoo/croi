<?php

namespace App\Controller;

use App\Entity\Sante;
use App\Repository\LogementRepository;
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
    public function index(
        SanteRepository $santeRepository, CommityRepository $commity, LogementRepository $logementRepository
    ): Response
    {
        $total_commity = count($commity->findAll());

        // santes
        $santesData = $santeRepository->findByDate();
        $santes = [] ;

        foreach($santesData as $key => $value){
            $tab['pourcentage'] = ($santesData[$key]['total'] * 100) / $total_commity;
            $tab['annee'] = $santesData[$key]['annee'];
            if (!array_key_exists($santesData[$key]['maladie'], $santes)) {
                $santes[$santesData[$key]['maladie']] = [];
            }
            array_push($santes[$santesData[$key]['maladie']], [$tab['annee'], $tab['pourcentage']]);
        }

        //education
        $educationData = $commity->findByEducation();
        $etudiants = [];
        $non_etudiants = [];

        foreach($educationData as $value){
            $tab['pourcentage'] = ($value['total'] * 100) / $total_commity;
            $tab['annee'] = $value['debut'];
            array_push($etudiants, [$tab['annee'], $tab['pourcentage']]);
            array_push($non_etudiants, [$tab['annee'], 100-$tab['pourcentage']]);
        }

        // logements
        $logDatas = $logementRepository->findByOwner();
        $logements = [
            'proprietaire' => ($logDatas['proprietaire']* 100) / $total_commity,
            'locataire' => ($logDatas['locataire']* 100) / $total_commity,
        ];

        return $this->render("home/index.html.twig", compact(
            'santes', 'etudiants', 'non_etudiants', 'total_commity', 'logements')
        );
    }

}