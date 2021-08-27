<?php

namespace App\Controller;

use App\Entity\Sante;
use App\Form\SanteType;
use App\Repository\SanteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/santes")
 */
class SantesController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_read_sante", methods={"GET"})
     */
    public function index(SanteRepository $santeRepository): Response
    {
    
        return $this->render('santes/index.html.twig', [
            'santes' => $santeRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="app_dashboard_create_sante", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sante = new Sante();
        $form = $this->createForm(SanteType::class, $sante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sante);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard_read_sante');
        }

        return $this->render('santes/new.html.twig', [
            'sante' => $sante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show/{id}", name="app_dashboard_show_sante", methods={"GET", "POST"})
     */
    public function show(Sante $sante, Request $request)
    {
        if($request->isXMLHttpRequest()){
            dd($request);
        }
        /*return $this->render('santes/show.html.twig', [
            'sante' => $sante,
        ]);*/
    }

    /**
     * @Route("/{id}/edit", name="app_dashboard_edit_sante", methods={"GET","POST"})
     */
    public function edit(Request $request, Sante $sante): Response
    {
        $form = $this->createForm(SanteType::class, $sante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_dashboard_read_sante');
        }

        return $this->render('santes/edit.html.twig', [
            'sante' => $sante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_delete_sante", methods={"POST"})
     */
    public function delete(Request $request, Sante $sante): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sante->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dashboard_read_sante');
    }
}
