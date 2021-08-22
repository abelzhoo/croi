<?php

namespace App\Controller;

use App\Entity\Commity;
use App\Entity\Sante;
use App\Entity\Education;
use App\Entity\Social;
use App\Entity\Logement;
use App\Entity\Sport;
use App\Entity\Profession;
use App\Entity\Tabligh;

use App\Form\CommityType;
use App\Form\SanteType;
use App\Form\EducationType;
use App\Form\SocialType;
use App\Form\LogementType;
use App\Form\SportType;
use App\Form\ProfessionType;
use App\Form\TablighType;

use App\Repository\CommityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commity")
 */
class CommityController extends AbstractController
{

    /**
     * @Route("/", name="app_dashboard_commity_read", methods={"GET"})
     */
    public function index(CommityRepository $commityRepository): Response
    {
        return $this->render('commity/index.html.twig', [
            'commities' => $commityRepository->findAll(),
        ]);
    }

   /**
    * @Route("/situation/{situation}", name="app_dashboard_dad_read")
    */
    public function getCommityDad(CommityRepository $commityRepository, $situation): Response
    {
        $listes = $commityRepository->findBy(['situationFamiliale' => $situation]);
        return $this->render('commity/index.html.twig', [
            'commities' => $listes,
            'title' => $situation
        ]);
        
    } 


    /**
     * @Route("/new", name="app_dashboard_commity_new", methods={"POST"})
     */
    public function new(Request $request):Response
    {
        $commity = new Commity();

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($commity);

        $form = $this->createForm(CommityType::class, $commity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            dd($commity);
            $entityManager->persist($commity);
            $entityManager->flush();
            return $this->redirectToRoute('app_dashboard_commity_read', [], Response::HTTP_SEE_OTHER);
        }
        return new Response('test');
    }

    /**
     *@Route("/create", name="app_dashboard_commity_create", methods={"GET","POST"})
     */
    public function create(Request $request)
    {
        $commity = new Commity();
        $form = $this->createForm(CommityType::class, $commity);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            dd($form);
        }

        return $this->render('commity/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_commity_show", methods={"GET"})
     */
    public function show(Commity $commity): Response
    {
        return $this->render('commity/show.html.twig', [
            'commity' => $commity,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_dashboard_commity_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commity $commity): Response
    {
        $form = $this->createForm(CommityType::class, $commity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_dashboard_commity_read', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commity/edit.html.twig', [
            'commity' => $commity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_commity_delete", methods={"POST"})
     */
    public function delete(Request $request, Commity $commity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commity->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dashboard_commity_read', [], Response::HTTP_SEE_OTHER);
    }
}
