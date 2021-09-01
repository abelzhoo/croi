<?php

namespace App\Controller;

use App\Entity\Deces;
use App\Form\DecesType;
use App\Repository\DecesRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/deces")
*/
class DecesController extends AbstractController
{
    /**
    * @Route("/", name="app_dashboard_deces_read", methods={"GET"})
    */
    public function index(DecesRepository $decesRepository):Response
    {
        if($this->get('security.token_storage')->getToken()->getUser() == "anon."){
            return $this->redirectToRoute('app_login');
        }
        
        return $this->render('deces/index.html.twig', [
            'deces' => $decesRepository->findAll()
        ]);
    }

    /**
     * @Route("/nouveau-deces", name="app_dashboard_deces_new")
     */
    public function new(Request $request)
    {
        $mort = new Deces();

        $form = $this->createForm(DecesType::class, $mort);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($mort);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard_deces_read', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('deces/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/voir", name="app_dashboard_deces_show")
     */
    public function show(Request $request):Response
    {
        if($request->isXmlHttpRequest()){
            $id = $request->request->get('id');
            $deces = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('App\Entity\Deces')->find((int)$id);

            return $this->json($deces, 200);

        }
        return new Response(null);
    }

    /**
     * @Route("/{id}/modifier", name="app_dashboard_deces_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Deces $deces): Response
    {
        $form = $this->createForm(DecesType::class, $deces);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_dashboard_deces_read', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('deces/edit.html.twig', [
            'deces' => $deces,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/supprimer", name="app_dashboard_deces_delete")
     */
    public function delete(Request $request): Response
    {
        if($request->isXmlHttpRequest()){
            $id = $request->request->get('id');
            $entityManager = $this->getDoctrine()->getManager();
            $deces = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('App\Entity\Deces')->find((int)$id);
            $entityManager->remove($deces);
            $entityManager->flush();

            return $this->json("Suppression réussite", 200);

        }
        return new Response(null);

    }


}