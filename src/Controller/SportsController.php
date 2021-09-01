<?php

namespace App\Controller;

use App\Entity\Sport;
use App\Form\SportType;
use App\Repository\SportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sports")
 */
class SportsController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_sport", methods={"GET"})
     */
    public function index(SportRepository $sportRepository): Response
    {
        if($this->get('security.token_storage')->getToken()->getUser() == "anon."){
            return $this->redirectToRoute('app_login');
        }
        
        return $this->render('sports/index.html.twig', [
            'sports' => $sportRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau-sport", name="app_dashboard_sport_create", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sport = new Sport();
        $form = $this->createForm(SportType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sport);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard_sport');
        }

        return $this->render('sports/new.html.twig', [
            'sport' => $sport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/voir", name="app_dashboard_sport_show")
     */
    public function show(Request $request): Response
    {
        if($request->isXmlHttpRequest()){
            $id = $request->request->get('id');
            $sport = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('App\Entity\Sport')->find((int)$id);

            return $this->json($sport, 200);

        }
        return new Response(null);
    }

    /**
     * @Route("/{id}/modifier", name="app_dashboard_sport_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sport $sport): Response
    {
        $form = $this->createForm(SportType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_dashboard_sport');
        }

        return $this->render('sports/edit.html.twig', [
            'sport' => $sport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/supprimer", name="app_dashboard_sport_delete", methods={"POST"})
     */
    public function delete(Request $request, Sport $sport): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sport->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dashboard_sport');
    }
}
