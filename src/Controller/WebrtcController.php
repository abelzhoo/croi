<?php

namespace App\Controller;

use App\Form\ExcelType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WebrtcController extends AbstractController
{
    /**
     * @Route("/call", name="app_call_chat")
     */
    public function index(Request $request)
    {

        return $this->render('webrtc/index.html.twig');

    }

}