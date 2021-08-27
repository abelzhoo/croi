<?php

namespace App\Controller;

use App\Entity\Tabligh;
use App\Form\TablighType;
use App\Repository\TablighRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/tablighs")
 */
class TablighsController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_tabligh", methods={"GET"})
     */
    public function index(TablighRepository $tablighRepository): Response
    {
        return $this->render('tablighs/index.html.twig', [
            'tablighs' => $tablighRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_dashboard_tabligh_create", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tabligh = new Tabligh();
        $form = $this->createForm(TablighType::class, $tabligh);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tabligh);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard_tabligh');
        }

        return $this->render('tablighs/new.html.twig', [
            'tabligh' => $tabligh,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_tabligh_show", methods={"GET"})
     */
    public function show(Tabligh $tabligh): Response
    {
        return $this->render('tablighs/show.html.twig', [
            'tabligh' => $tabligh,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_dashboard_tabligh_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tabligh $tabligh): Response
    {
        dd('test');
        $form = $this->createForm(TablighType::class, $tabligh);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_dashboard_tabligh');
        }

        return $this->render('tablighs/edit.html.twig', [
            'tabligh' => $tabligh,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tablighs_delete", methods={"POST"})
     */
    public function delete(Request $request, Tabligh $tabligh): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tabligh->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tabligh);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dashboard_tabligh');
    }
}
