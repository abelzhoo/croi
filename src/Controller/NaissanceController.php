<?php

namespace App\Controller;

use App\Entity\Enfant;
use App\Form\EnfantType;
use App\Repository\EnfantRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/admin")
*/
class NaissanceController extends AbstractController
{
    /**
    * @Route("/enfants", name="app_dashboard_enfant_read")
    */
    public function index(EnfantRepository $enfantRepository):Response
    {
        return $this->render('naissance/index.html.twig', ['enfants' => $enfantRepository->findAll()]);
    }

    /**
     * @Route("/enfant/new", name="app_dashboard_enfant_new")
     */
    public function new(Request $request):Response
    {
        $enfant = new Enfant();

        $form = $this->createForm(EnfantType::class, $enfant);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($enfant);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard_enfant_read', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('naissance/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

}