<?php

namespace App\Controller;

use App\Form\ContactType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    /**
     * @Route("/admin/email", name="send_email")
     */
    public function index(Request $request, \Swift_Mailer $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            $message = (new \Swift_Message('Nouveau Contact'))
                ->setFrom($contact['email'])
                ->setTo('webmaster@recensement.croi-mada.org')
                ->setBody($this->renderView(
                    'email/email.html.twig', compact('contact')
                ), 'text/html');

                $mailer->send($message);
                $this->addFlash('message', 'Le message a été bien envoyé');
                //return $this->redirectToRoute('')
        }

        return $this->render('email/index.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }

}