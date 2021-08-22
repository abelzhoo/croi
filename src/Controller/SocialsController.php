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
 * @Route("/admin/socials")
 */
class SocialsController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_social_read", methods={"GET"})
     */
    public function index(SocialRepository $socialRepository): Response
    {
        return $this->render('socials/index.html.twig', [
            'socials' => $socialRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_dashboard_social_create", methods={"GET","POST"})
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
     * @Route("/{id}", name="app_dashboard_social_show", methods={"GET"})
     */
    public function show(Social $social): Response
    {
        return $this->render('socials/show.html.twig', [
            'social' => $social,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_dashboard_social_edit", methods={"GET","POST"})
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
     * @Route("/supr={id}", name="app_dashboard_social_delete", methods={"POST"})
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
