<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 05/12/17
 * Time: 09:49
 */

namespace AppBundle\Service;


use Swift_Image;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Finder\Finder;


class EmailService
{

    const SENDER = "HappySens Notifications";

    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var \Twig_Environment
     */
    protected $template;

    /**
     * @var string
     */
    protected $sender;

    /**
     * @var string
     */
    private $db;

    /**
     * @var
     */
    private $directory;

    /**
     * EmailService constructor.
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $template
     * @param $sender
     * @param RegistryInterface $db
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $template, $sender, RegistryInterface $db, $directory)
    {
        $this->mailer = $mailer;
        $this->template = $template;
        $this->sender = $sender;
        $this->db = $db;
        $this->directory = $directory;
    }

    /**
     * @param $contact
     * @param $email_contact
     */
    public function sendMessageContact($contact, $email_contact)
    {
        $message = \Swift_Message::newInstance();
        $img = $message->embed(Swift_Image::fromPath($this->directory . '/web/assets/images/logo2.png'));

        $message->setSubject("Merci d'avoir contacté HappySens")
            ->setCharset("utf-8")
            ->setTo([$contact->getEmail()])
            ->setFrom([$this->sender => self::SENDER])
            ->setBody(
                $this->template->render('notificationsEmail/categories/contact/contact.html.twig', [
                    'firstName' => $contact->getFirstName(),
                    'lastName' => $contact->getLastName(),
                    'email'=> $contact->getEmail(),
                    'phone' => $contact->getPhone(),
                    'company' => $contact->getNameCompany(),
                    'status' => $contact->getStatus(),
                    'message' => $contact->getMessage(),
                    'logo' => $img,
                ]), 'text/html')
            ->addPart($this->template->render('notificationsEmail/categories/contact/contact.txt.twig', [
                'firstName' => $contact->getFirstName(),
                'lastName' => $contact->getLastName(),
                'email'=> $contact->getEmail(),
                'phone' => $contact->getPhone(),
                'company' => $contact->getNameCompany(),
                'status' => $contact->getStatus(),
                'message' => $contact->getMessage(),
            ]), 'text/plain');

        $this->mailer->send($message);
    }

    /**
     * @param $project
     * @param $email_contact
     */
    public function sendMailProject($project, $email_contact)
    {
        $message = \Swift_Message::newInstance();
        $img = $message->embed(Swift_Image::fromPath($this->directory . '/web/assets/images/logo2.png'));

        $message->setSubject('Votre projet a bien été créé')
            ->setCharset("utf-8")
            ->setTo([$project->getAuthor()->getEmail()])
            ->setFrom([$this->sender => self::SENDER])
            ->setBody(
                $this->template->render('notificationsEmail/categories/project/newProject.html.twig', [
                    'logo' => $img,
                    'author' => $project->getAuthor(),
                    'status' => $project->getStatus(),
                    'title' => $project->getTitle(),
                    'location' => $project->getLocation(),
                ]), 'text/html'
            )
            ->addPart($this->template->render('notificationsEmail/categories/project/newProject.txt.twig', [
                'author' => $project->getAuthor(),
                'status' => $project->getStatus(),
                'title' => $project->getTitle(),
                'location' => $project->getLocation(),
            ]), 'text/plain');

        $this->mailer->send($message);
    }

    /**
     * @param $mailUser
     * @param $email_contact
     * @param $firstName
     * @param $lastName
     * @param $token
     */
    public function sendMailNewPwd($mailUser, $email_contact, $firstName, $lastName, $token)
    {
        $message = \Swift_Message::newInstance();
        $img = $message->embed(Swift_Image::fromPath($this->directory . '/web/assets/images/logo2.png'));
        $message->setSubject('Réinitialisation de votre mot de passe')
            ->setCharset("utf-8")
            ->setTo([$mailUser])
            ->setFrom([$this->sender => self::SENDER])
            ->setBody(
                $this->template->render('notificationsEmail/categories/resetPassword/resetPassword.html.twig', [
                    'logo' => $img,
                    'firstname' => $firstName,
                    'lastName' => $lastName,
                    'token' => $token,
                ]), 'text/html'
            )
            ->addPart($this->template->render('notificationsEmail/categories/resetPassword/resetPassword.txt.twig', [
                'logo' => $img,
                'firstname' => $firstName,
                'lastName' => $lastName,
                'token' => $token,
            ]), 'text/plain');

        $this->mailer->send($message);
    }

    /**
     * @param $user
     * @param $email_contact
     * @param $valueMdp
     */
    public function sendMailNewUser($user, $email_contact, $valueMdp)
    {
        $message = \Swift_Message::newInstance();
        $img = $message->embed(Swift_Image::fromPath($this->directory . '/web/assets/images/logo2.png'));
        $message->setSubject("Votre compte happySens vient d'être créé")
            ->setCharset("utf-8")
            ->setTo([$user->getEmail()])
            ->setFrom([$this->sender => self::SENDER])
            ->setBody(
                $this->template->render('notificationsEmail/categories/inscriptions/employe/newUser.html.twig', [
                    'logo' => $img,
                    'firstname' => $user->getFirstName(),
                    'lastname' => $user->getLastName(),
                    'email' => $user->getEmail(),
                    'password' => $valueMdp,
                ]), 'text/html'
            )
            ->addPart($this->template->render('notificationsEmail/categories/inscriptions/employe/newUser.txt.twig', [
                'firstname' => $user->getFirstName(),
                'lastname' => $user->getLastName(),
                'email' => $user->getEmail(),
                'password' => $valueMdp,
            ]), 'text/plain');

        $this->mailer->send($message);
    }

    /**
     * @param $company
     * @param $email_contact
     * @param $valueMdp
     * @param $referent
     */
    public function sendMailNewCompany($company, $email_contact, $valueMdp, $referent)
    {
        $message = \Swift_Message::newInstance();
        $img = $message->embed(Swift_Image::fromPath($this->directory . '/web/assets/images/logo2.png'));
        $message->setSubject("Votre compte entreprise HappySens vient d'être créé")
            ->setCharset("utf-8")
            ->setTo([$referent])
            ->setFrom([$this->sender => self::SENDER])
            ->setBody(
                $this->template->render('notificationsEmail/categories/inscriptions/company/newCompany.html.twig', [
                    'logo' => $img,
                    'name' => $company->getName(),
                    'nbSalary' => $company->getNbSalary(),
                    'email' => $referent,
                    'password' => $valueMdp,
                ]), 'text/html'
            )
            ->addPart($this->template->render('notificationsEmail/categories/inscriptions/company/newCompany.txt.twig', [
                'firstname' => $company->getName(),
                'lastname' => $company->getNbSalary(),
                'email' => $referent,
                'password' => $valueMdp,
            ]), 'text/plain');

        $this->mailer->send($message);
    }

    /**
     * @param $project
     * @param $email_contact
     */
    public function sendMailProjectValidate($project, $email_contact)
    {
        $message = \Swift_Message::newInstance();
        $img = $message->embed(Swift_Image::fromPath($this->directory . '/web/assets/images/logo2.png'));

        $message->setSubject('Votre projet a été validé')
            ->setCharset("utf-8")
            ->setTo([$project->getAuthor()->getEmail()])
            ->setFrom([$this->sender => self::SENDER])
            ->setBody(
                $this->template->render('notificationsEmail/categories/validateProject/validateProject.html.twig', [
                    'logo' => $img,
                    'author' => $project->getAuthor(),
                    'title' => $project->getTitle(),
                ]), 'text/html'
            )
            ->addPart($this->template->render('notificationsEmail/categories/validateProject/validateProject.txt.twig', [
                'author' => $project->getAuthor(),
                'title' => $project->getTitle(),
            ]), 'text/plain');

        $this->mailer->send($message);
    }
}