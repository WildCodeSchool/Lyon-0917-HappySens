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
                    $this->renderView('notificationsEmail/contact.html.twig', [
                        'firstName' => $contact->getFirstName(),
                        'lastName' => $contact->getLastName(),
                        'phone' => $contact->getPhone(),
                        'company' => $contact->getNameCompany(),
                        'status' => $contact->getStatus(),
                        'message' => $contact->getMessage()
                    ]),
                    'text/html'
                );
            $mailer->send($message);

            $this->addFlash(
                'contact',
                'Merci, votre message a bien été envoyé.'
            );

            return $this->redirectToRoute('homepage');
        }
        return $this->render('pages/contact.html.twig',[
            'form' => $form->createView(),
        ]);

    }
}