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
 * @Route("/santes")
 */
class SantesController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_read_sante", methods={"GET"})
     */
    public function index(SanteRepository $santeRepository): Response
    {
        if($this->get('security.token_storage')->getToken()->getUser() == "anon."){
            return $this->redirectToRoute('app_login');
        }
        
        return $this->render('santes/index.html.twig', [
            'santes' => $santeRepository->findAll()
        ]);
    }

    /**
     * @Route("/nouveau-sante", name="app_dashboard_create_sante", methods={"GET","POST"})
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
     * @Route("/{id}/voir", name="app_dashboard_show_sante")
     */
    public function show(Request $request)
    {
        if($request->isXmlHttpRequest()){
            $id = $request->request->get('id');
            $sante = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('App\Entity\Sante')->find((int)$id);

            return $this->json($sante, 200);

        }
        return new Response(null);
    }

    /**
     * @Route("/{id}/modifier", name="app_dashboard_edit_sante", methods={"GET","POST"})
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
     * @Route("/{id}/supprimer", name="app_dashboard_delete_sante", methods={"POST"})
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
