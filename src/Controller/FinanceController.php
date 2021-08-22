<?php

namespace App\Controller;

use App\Entity\Finance;
use App\Form\FinanceType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class FinanceController extends AbstractController
{
    /**
     * @Route("/admin/finance", name="app_dashboard_finance")
     */
    public function finance(): Response
    {
        $finances = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('App\Entity\Finance')->findAll();
        return $this->render('finance/index.html.twig', [
            'controller_name' => 'FinanceController',
            'finances' => $finances,
            'title' => 'Département Finance'
        ]);
    }

    /**
     * @Route("/finance/create", name="app_dashboard_finance_create")
     */
    public function create(Request $request){
        
        $finance = new Finance();

        $form = $this->createForm(FinanceType::class, $finance);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($finance);
            $em->flush();
            $this->addFlash('success', 'Ajout Finance avec succèss!!!');
            return $this->redirectToRoute('app_dashboard_finance');
        }
        return $this->render('finance/create.html.twig', [
            'controller_name' => 'FinanceController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/finance/edit/{id}", name="app_dashboard_finance_edit")
     */
    public function edit(Finance $finance, Request $request, EntityManagerInterface $em):Response
    {
        $form = $this->createForm(FinanceType::class, $finance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $em->flush();
            $this->addFlash('success', 'Edition succèss!!!');
            return $this->redirectToRoute('app_dashboard_finance');
        }

        return $this->render('finance/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/finance/delete/{id}", name="app_dashboard_finance_delete")
     */
    public function delete($id, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $financeRepo = $em->getRepository('App\Entity\Finance');
        $finance = $financeRepo->find($id);
        
        if($finance){
            $em->remove($finance);
            $em->flush();
            $this->addFlash('success', 'Finance supprimer avec success !!!');
            return $this->redirectToRoute('app_dashboard_finance');
        }
        return new Response(null, 204);
    }
}