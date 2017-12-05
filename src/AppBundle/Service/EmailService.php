<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 05/12/17
 * Time: 09:49
 */

namespace AppBundle\Service;


class EmailService
{
    protected $mailer;
    protected $template;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $template)
    {
        $this->mailer = $mailer;
        $this->template = $template;
    }

    public function sendMessageContact($contact)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Merci d\'avoir contacté HappySens')
            ->setFrom($contact->getEmail(), $contact->getFirstName() . ' ' . $contact->getLastName())
            ->setTo('famar.wcslyon@gmail.com')
            ->setBcc($contact->getEmail(), 'contact HappySens')
            ->setReplyTo('famar.wcslyon@gmail.com')
            ->setBody(
                $this->template->render('notificationsEmail/contact.html.twig', [
                    'firstName' => $contact->getFirstName(),
                    'lastName' => $contact->getLastName(),
                    'email'=> $contact->getEmail(),
                    'phone' => $contact->getPhone(),
                    'company' => $contact->getNameCompany(),
                    'status' => $contact->getStatus(),
                    'message' => $contact->getMessage()
                ]),
                'text/html'
            );
        $this->mailer->send($message);
    }

}