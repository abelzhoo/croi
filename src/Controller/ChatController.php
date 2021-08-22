<?php

namespace App\Controller;

use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ChatController extends AbstractController
{
    /**
     * @Route("/message", name="app_dashboard_chat")
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()
                      ->getManager()
                      ->getRepository('App\Entity\User')->findAll();

        return $this->render('chat/index.html.twig', [
            'controller_name' => 'ChatController',
            'users' => $users,
            'title' => 'Inbox'
        ]);
    }

    /**
     * @Route("/message?user_id={id}", name="app_dashboard_chat_id")
     */
    public function getId(Request $request){

        if($request->isXMLHttpRequest()){

            $unique_id = $request->request->get('id');
            $user = $this->getDoctrine()
                      ->getManager()
                      ->getRepository('App\Entity\User')->find((int)$id);

            return $this->json($user, 200);
        }
        
        return new Response('ok');
    }

}