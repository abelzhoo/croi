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
class DecesController extends AbstractController
{
    /**
    * @Route("/deces", name="app_dashboard_deces_read", methods={"GET"})
    */
    public function index(DecesRepository $decesRepository):Response
    {
        return $this->render('deces/index.html.twig', [
            'deces' => $decesRepository->findAll()
        ]);
    }

    /**
     * @Route("/deces/new", name="app_dashboard_deces_new")
     */
    public function new(Request $request)
    {
        $mort = new Deces();

        $form = $this->createForm(DecesType::class, $mort);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($mort);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard_deces_read', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('deces/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

}