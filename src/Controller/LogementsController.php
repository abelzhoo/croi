<?php

namespace App\Controller;

use App\Entity\Logement;
use App\Form\LogementType;
use App\Repository\LogementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/logements")
 */
class LogementsController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_logement_read", methods={"GET"})
     */
    public function index(LogementRepository $logementRepository): Response
    {
        return $this->render('logements/index.html.twig', [
            'logements' => $logementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau-habitat", name="app_dashboard_logement_create", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $logement = new Logement();
        $form = $this->createForm(LogementType::class, $logement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($logement);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard_logement_read');
        }

        return $this->render('logements/new.html.twig', [
            'logement' => $logement,
            'form' => $form->createView(),
        ]);
    }

    /**
    * @Route("/province", name="personne_peer_province", methods={"GET","POST"})
    */
    public function getNameProvince(LogementRepository $logementRepository, Request $request): Response
    {  
        if($request->isXmlHttpRequest()) {
            $province = $request->request->get('region');
            $datas = $logementRepository->findByProvinces($province);
            return new JsonResponse($datas); 
        }
        return new Response('ok');
    }

    /**
     * @Route("/{id}/voir", name="app_dashboard_logement_show")
     */
    public function show(Request $request): Response
    {
        if($request->isXmlHttpRequest()){
            $id = $request->request->get('id');
            $logement = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('App\Entity\Logement')->find((int)$id);

            return $this->json($logement, 200);

        }
        return new Response(null);
    }

    /**
     * @Route("/{id}/modifier", name="app_dashboard_logement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Logement $logement): Response
    {
        $form = $this->createForm(LogementType::class, $logement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_dashboard_logement_read');
        }

        return $this->render('logements/edit.html.twig', [
            'logement' => $logement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/supprimer", name="app_dashboard_logement_delete", methods={"POST"})
     */
    public function delete(Request $request, Logement $logement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$logement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($logement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dashboard_logement_read');
    }
}
