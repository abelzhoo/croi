<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ErrorController extends AbstractController
{
    /**
     * @Route("/admin/accueil", name="app_dashboard_home")
     */
    public function show(Request $request): Response
    {
        if($this->createAccessDeniedException()){
            return $this->render("errors/error403.html.twig");
        }else if($this->createNotFoundException()){
            return $this->render("errors/error404.html.twig");
        }
    }

}