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
    public function getPersonne(CommityRepository $commityRepository, $situation): Response
    {
        $listes = $commityRepository->findBy(['situationFamiliale' => $situation]);
        return $this->render('commity/index.html.twig', [
            'commities' => $listes,
            'title' => $situation,
            'current_menu' => $situation
        ]);
        
    } 

    /**
     *@Route("/nouveau-personne", name="app_dashboard_commity_create", methods={"GET","POST"})
     */
    public function create(Request $request)
    {
        $commity = new Commity();

        $form = $this->createForm(CommityType::class, $commity);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $commity->setSante($commity->getSante());
            $commity->setSocial($commity->getSocial());
            $commity->setTabligh($commity->getTabligh());
            $datas = $commity->getPossession();
            
            foreach($datas as $data){
                $commity->addPossession($data);
            }

            $datasEducations = $commity->getEtudiant();
            foreach($datasEducations as $data){
                $commity->addEtudiant($data);
            }

            $datasSports = $commity->getSport();
            foreach($datasSports as $data){
                $commity->addSport($data);
            }

            $datasProfessions = $commity->getProfession();
            foreach($datasProfessions as $data){
                $commity->addProfession($data);
            }
  
            $entityManager->persist($commity);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard_commity_read', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commity/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/voir", name="app_dashboard_commity_show")
     */
    public function show(Request $request):Response
    {
        if($request->isXmlHttpRequest()){
            $id = $request->request->get('id');
            $commity = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('App\Entity\Commity')->find((int)$id);

            return $this->json($commity, 200);

        }
        return new Response('ok');
    }

    /**
     * @Route("/{id}/modifier", name="app_dashboard_commity_edit", methods={"GET","POST"})
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
     * @Route("/{id}/supprimer", name="app_dashboard_commity_delete")
     */
    public function delete(Request $request, Commity $commity): Response
    {
        //if ($this->isCsrfTokenValid('delete'.$commity->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commity);
            $entityManager->flush();
        //}

        return $this->redirectToRoute('app_dashboard_commity_read', [], Response::HTTP_SEE_OTHER);
    }
}
