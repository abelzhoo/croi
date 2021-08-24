<?php

namespace App\Controller;

use App\Entity\Deces;
use App\Form\DecesType;
use App\Repository\DecesRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/admin")
*/
class ErrorController extends AbstractController
{
    /**
    * @Route("/", name="app_dashboard_error_read", methods={"GET"})
    */
    public function show():Response
    {
        return $this->render('bundles/TwigBundle/Exception/error.html.twig');
    }

}