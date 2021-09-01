<?php

namespace App\Controller;

use App\Entity\Education;
use App\Form\EducationType;
use App\Repository\EducationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/educations")
 */
class EducationsController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_education_read", methods={"GET"})
     */
    public function index(EducationRepository $educationRepository): Response
    {
        if($this->get('security.token_storage')->getToken()->getUser() == "anon."){
            return $this->redirectToRoute('app_login');
        }
        
        return $this->render('educations/index.html.twig', [
            'educations' => $educationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau-etudiant", name="app_dashboard_education_create", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $education = new Education();
        $form = $this->createForm(EducationType::class, $education);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($education);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard_education_read');
        }

        return $this->render('educations/new.html.twig', [
            'education' => $education,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/voir", name="app_dashboard_education_show")
     */
    public function show(Request $request)
    {
        if($request->isXmlHttpRequest()){
            $id = $request->request->get('id');
            $education = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('App\Entity\Education')->find((int)$id);

            return $this->json($education, 200);

        }
        return new Response(null);
    }

    /**
     * @Route("/{id}/modifier", name="app_dashboard_education_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Education $education): Response
    {
        $form = $this->createForm(EducationType::class, $education);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('app_dashboard_education_read');
        }

        return $this->render('educations/edit.html.twig', [
            'education' => $education,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/supprimer", name="app_dashboard_education_delete", methods={"POST"})
     */
    public function delete(Request $request, Education $education): Response
    {
        if ($this->isCsrfTokenValid('delete'.$education->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($education);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dashboard_education_read');
    }
}
