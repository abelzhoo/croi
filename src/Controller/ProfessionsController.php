<?php

namespace App\Controller;

use App\Entity\Profession;
use App\Form\ProfessionType;
use App\Repository\ProfessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/professions")
 */
class ProfessionsController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_profession", methods={"GET"})
     */
    public function index(ProfessionRepository $professionRepository): Response
    {
        if($this->get('security.token_storage')->getToken()->getUser() == "anon."){
            return $this->redirectToRoute('app_login');
        }
        
        return $this->render('professions/index.html.twig', [
            'professions' => $professionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau-profession", name="app_dashboard_commerce_create", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $profession = new Profession();
        $form = $this->createForm(ProfessionType::class, $profession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profession);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard_profession');
        }

        return $this->render('professions/new.html.twig', [
            'profession' => $profession,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/voir", name="app_dashboard_commerce_show")
     */
    public function show(Request $request): Response
    {
        if($request->isXmlHttpRequest()){
            $id = $request->request->get('id');
            $profession = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('App\Entity\Profession')->find((int)$id);

            return $this->json($profession, 200);

        }
        return new Response(null);
    }

    /**
     * @Route("/{id}/modifier", name="app_dashboard_commerce_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Profession $profession): Response
    {
        $form = $this->createForm(ProfessionType::class, $profession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_dashboard_profession');
        }

        return $this->render('professions/edit.html.twig', [
            'profession' => $profession,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/supprimer", name="app_dashboard_commerce_delete", methods={"POST"})
     */
    public function delete(Request $request, Profession $profession): Response
    {
        if ($this->isCsrfTokenValid('delete'.$profession->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($profession);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dashboard_profession');
    }
}
