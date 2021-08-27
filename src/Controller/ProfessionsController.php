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
 * @Route("/admin/professions")
 */
class ProfessionsController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_profession", methods={"GET"})
     */
    public function index(ProfessionRepository $professionRepository): Response
    {
        return $this->render('professions/index.html.twig', [
            'professions' => $professionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_dashboard_commerce_create", methods={"GET","POST"})
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

            return $this->redirectToRoute('app_dashboard_commerce_delete');
        }

        return $this->render('professions/new.html.twig', [
            'profession' => $profession,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_commerce_show", methods={"GET"})
     */
    public function show(Profession $profession): Response
    {
        return $this->render('professions/show.html.twig', [
            'profession' => $profession,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_dashboard_commerce_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Profession $profession): Response
    {
        $form = $this->createForm(ProfessionType::class, $profession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_dashboard_commerce_delete');
        }

        return $this->render('professions/edit.html.twig', [
            'profession' => $profession,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_commerce_delete", methods={"POST"})
     */
    public function delete(Request $request, Profession $profession): Response
    {
        if ($this->isCsrfTokenValid('delete'.$profession->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($profession);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dashboard_commerce_delete');
    }
}
