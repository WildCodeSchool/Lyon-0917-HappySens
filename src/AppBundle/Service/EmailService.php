<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 05/12/17
 * Time: 09:49
 */

namespace AppBundle\Service;


use Swift_Image;

class EmailService
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var \Twig_Environment
     */
    protected $template;

    /**
     * EmailService constructor.
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $template
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $template)
    {
        $this->mailer = $mailer;
        $this->template = $template;
    }

    /**
     * @param $contact
     * @param $email_contact
     */
    public function sendMessageContact($contact, $email_contact)
    {
        $message = \Swift_Message::newInstance();
        $img = $message->embed(Swift_Image::fromPath('assets/images/logo2.png'));

        $message->setSubject('Merci d\'avoir contacté HappySens')
            ->setCharset("utf-8")
            ->setTo([$email_contact, $contact->getEmail()])
            ->setBody(
                $this->template->render('notificationsEmail/categories/contact/contact.txt.twig', [
                    'firstName' => $contact->getFirstName(),
                    'lastName' => $contact->getLastName(),
                    'email'=> $contact->getEmail(),
                    'phone' => $contact->getPhone(),
                    'company' => $contact->getNameCompany(),
                    'status' => $contact->getStatus(),
                    'message' => $contact->getMessage(),
                    'logo' => $img,
                ]), 'text/html'
            )
            ->addPart($this->template->render('notificationsEmail/categories/contact/contact.txt.twig', [
                'firstName' => $contact->getFirstName(),
                'lastName' => $contact->getLastName(),
                'email'=> $contact->getEmail(),
                'phone' => $contact->getPhone(),
                'company' => $contact->getNameCompany(),
                'status' => $contact->getStatus(),
                'message' => $contact->getMessage(),
                'logo' => $img,
            ]), 'text/plain');

        $this->mailer->send($message);
    }

    public function sendMails($contact, $email_contact)
    {
        $message = \Swift_Message::newInstance();
        $img = $message->embed(Swift_Image::fromPath('assets/images/logo2.png'));

        $message->setSubject('Merci d\'avoir contacté HappySens')
            ->setCharset("utf-8")
            ->setTo([$email_contact, $contact->getEmail()])
            ->setBody(
                $this->template->render('notificationsEmail/categories/contact/contact.txt.twig', [
                    'firstName' => $contact->getFirstName(),
                    'lastName' => $contact->getLastName(),
                    'email'=> $contact->getEmail(),
                    'phone' => $contact->getPhone(),
                    'company' => $contact->getNameCompany(),
                    'status' => $contact->getStatus(),
                    'message' => $contact->getMessage(),
                    'logo' => $img,
                ]), 'text/html'
            )
            ->addPart($this->template->render('notificationsEmail/categories/contact/contact.txt.twig', [
                'firstName' => $contact->getFirstName(),
                'lastName' => $contact->getLastName(),
                'email'=> $contact->getEmail(),
                'phone' => $contact->getPhone(),
                'company' => $contact->getNameCompany(),
                'status' => $contact->getStatus(),
                'message' => $contact->getMessage(),
                'logo' => $img,
            ]), 'text/plain');

        $this->mailer->send($message);
    }
}