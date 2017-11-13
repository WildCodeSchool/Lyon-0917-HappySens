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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request)
    {
        $contact = new EmailContact();
        $form = $this->createForm(EmailContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {

            return $this->redirectToRoute('/');
        }
        return $this->render('pages/contact.html.twig',[
            'form' => $form->createView(),
        ]);

    }
}