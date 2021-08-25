<?php

namespace App\Controller;

use App\Entity\Mariage;
use App\Form\MariageType;
use App\Repository\MariageRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/admin")
*/
class MariageController extends AbstractController
{
    /**
    * @Route("/mariage", name="app_dashboard_mariage_read")
    */
    public function index(MariageRepository $mariageRepository):Response
    {
        return $this->render('mariage/index.html.twig', ['mariages' => $mariageRepository->findAll()]);
    }

    /**
     * @Route("/mariage/new", name="app_dashboard_mariage_new")
     */
    public function new(Request $request):Response
    {
        $mariage = new Mariage();

        $form = $this->createForm(MariageType::class, $mariage);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($mariage);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard_mariage_read', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('mariage/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

}