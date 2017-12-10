<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EmailContact;
use AppBundle\Form\EmailContactType;
use AppBundle\Service\EmailService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EmailContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request, EmailService $emailService)
    {
        $contact = new EmailContact();
        $form = $this->createForm(EmailContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $email_contact = $this->container->getParameter('email_contact');
            $emailService->sendMessageContact($contact, $email_contact);
            $this->addFlash(
                'contact',
                'Merci, votre message a bien été envoyé.'
            );

            return $this->redirectToRoute('homepage');
        }
        return $this->render('pages/Out/contact.html.twig',[
            'form' => $form->createView(),
        ]);

    }
}