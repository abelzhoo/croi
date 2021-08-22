<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class FilterController extends AbstractController
{

    /**
     * @Route("/commity/pere", name="app_filter_dad")
     */
    public function index(Request $request):Response
    {
        //$entityManager = $this->getDoctrine()->getManager()->findBy(['situationFamilliale' => ]);

    }

}

?>