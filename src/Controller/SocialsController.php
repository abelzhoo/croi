<?php

namespace App\Controller;

use App\Entity\Social;
use App\Form\SocialType;
use App\Repository\SocialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/socials")
 */
class SocialsController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_social_read", methods={"GET"})
     */
    public function index(SocialRepository $socialRepository): Response
    {
        if($this->get('security.token_storage')->getToken()->getUser() == "anon."){
            return $this->redirectToRoute('app_login');
        }
        
        return $this->render('socials/index.html.twig', [
            'socials' => $socialRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau-social", name="app_dashboard_social_create", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $social = new Social();
        $form = $this->createForm(SocialType::class, $social);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($social);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard_social_read');
        }

        return $this->render('socials/new.html.twig', [
            'social' => $social,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/voir", name="app_dashboard_social_show")
     */
    public function show(Request $request): Response
    {
        if($request->isXmlHttpRequest()){
            $id = $request->request->get('id');
            $social = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('App\Entity\Social')->find((int)$id);

            return $this->json($social, 200);

        }
        return new Response(null);
    }

    /**
     * @Route("/{id}/modifier", name="app_dashboard_social_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Social $social): Response
    {
        $form = $this->createForm(SocialType::class, $social);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_dashboard_social_read');
        }

        return $this->render('socials/edit.html.twig', [
            'social' => $social,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supr={id}/supprimer", name="app_dashboard_social_delete", methods={"POST"})
     */
    public function delete(Request $request, Social $social): Response
    {
        if ($this->isCsrfTokenValid('delete'.$social->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($social);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dashboard_social_read');
    }
}
