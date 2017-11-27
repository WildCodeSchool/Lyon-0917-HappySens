<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EmailContact;
use AppBundle\Form\EmailContactType;
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
    public function contactAction(Request $request, \Swift_Mailer $mailer)
    {
        $contact = new EmailContact();
        $form = $this->createForm(EmailContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $message = (new \Swift_Message('Contact HappySens'))
                ->setFrom($contact->getEmail())
                ->setTo('famar.wcslyon@gmail.com')
                ->setBody(
                    $this->renderView('partials/components/notificationsEmail/contact.html.twig'),
                    'text/html'
                );
            $mailer->send($message);
            return $this->redirectToRoute('homepage');
        }
        return $this->render('pages/contact.html.twig',[
            'form' => $form->createView(),
        ]);

    }
}