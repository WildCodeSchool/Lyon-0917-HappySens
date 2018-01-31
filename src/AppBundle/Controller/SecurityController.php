<?php
namespace AppBundle\Controller;
use AppBundle\Entity\ChangePwd;
use AppBundle\Form\ChangePwdType;
use AppBundle\Service\NotificationService;
use AppBundle\Service\EmailService;
use Faker\Provider\DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        // Login erreur
        $error = $authUtils->getLastAuthenticationError();

        // dernier nom entre par le user
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('pages/In/security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/sendChange", name="sendChange")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param EmailService $emailService
     * @param NotificationService $checkSecurityService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sendChangeAction(Request $request, EmailService $emailService, NotificationService $checkSecurityService)
    {
        $changePwd = new Changepwd();
        $form = $this->createForm('AppBundle\Form\ChangePwdType', $changePwd);
        $form->remove('token')
             ->remove('idUser')
             ->remove('dateSend');
        $form->handleRequest($request);
        $error = '';

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $mail = $changePwd->getEmail();
            $user = $em->getRepository('AppBundle:User')->findByEmail($mail);
            if (!empty($user)) {
                foreach ($user as $item) {
                    if ($mail == $item->getEmail()) {
                        $changePwd->setIdUser($item->getId())
                            ->setEmail($item->getEmail())
                            ->setDateSend(new \DateTime('now'))
                            ->setToken($item->getFirstName(), $mail, $item->getId());
                        $changePwd->setIsActive(false);
                        $email_contact = $this->container->getParameter('email_contact');
                        $emailService->sendMailNewPwd($mail, $email_contact, $item->getFirstName(), $item->getLastName(), $changePwd->getToken());
                    } else {
                        // TODO : Afficher les erreurs
                        $error = 'Adresse email invalide, réessayer.';
                        return $this->render('pages/In/security/send.html.twig', array(
                            'changePwd' => $changePwd,
                            'error' => $error,
                            'form' => $form->createView(),
                        ));
                    }
                    $em->persist($changePwd);
                    $em->flush();
                }
            } else {
                // TODO : Afficher les erreurs
                $error = 'Adresse email invalide, réessayer.';
                return $this->render('pages/In/security/send.html.twig', array(
                    'changePwd' => $changePwd,
                    'error' => $error,
                    'form' => $form->createView(),
                ));
            }
            return $this->render('pages/In/security/login.html.twig', array(
                'changePwd' => $changePwd,
                'form' => $form->createView(),
            ));
        }
        // TODO : Afficher les erreurs

        return $this->render('pages/In/security/send.html.twig', array(
            'changePwd' => $changePwd,
            'errors' => $error,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{token}/change", name="create")
     * @Method({"GET", "POST"})
     *
     * @param ChangePwd $changePwd
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function changeAction(ChangePwd $changePwd, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // TODO: Refactoriser dans un service
        $errors = '';
        $sendToken = $request->attributes->get('token');
        $userToken = $changePwd->getToken();
        $form = $this->createForm('AppBundle\Form\EditPasswordType', $changePwd);
        $form->handleRequest($request);

        // TODO : test avec plusieurs demande en meme temps, car obligation de supprimer chaque ligne, si test fail créer une requete pour verifier que L'id user === idUser de $changePwd
        if ($changePwd->getisActive() === false){
            if ($userToken === $sendToken) {
                $em = $this->getDoctrine()->getManager();
                $changePwd->setIsActive(true);
                $senderUser = $em->getRepository('AppBundle:User')->findById($changePwd->getIdUser());

                if ($form->isSubmitted() && $form->isValid()) {
                    foreach($senderUser as $user) {
                        $contentSend = $request->request;
                        foreach($contentSend as $data) {
                            $sendPwd = $data['pwd'];
                            $confirmSendPwd = $data['confirmPwd'];
                            if($sendPwd === $confirmSendPwd) {
                                $password = $passwordEncoder->encodePassword($user, $sendPwd);
                                $user->setPassword($password);
                                $em->persist($changePwd);
                                $em->persist($user);
                                $em->remove($changePwd);
                                $em->flush();
                                return $this->render('pages/In/security/login.html.twig');
                            }
                            else {
                                $errors = 'Les deux saisies ne sont pas identiques.';
                                // TODO : Afficher les erreurs
                                return $this->render('pages/In/security/change.html.twig', [
                                    'token' => $changePwd->getToken(),
                                    'errors' => $errors,
                                    'form' => $form->createView(),
                                ]);
                            }
                        }

                    }
                }
            } else {
                $errors = "La page demandée n'existe plus.";
                // TODO : Afficher les erreurs
                return $this->render('pages/In/security/login.html.twig', [
                    'errors' => $errors,
                ]);
            }
        } else {
            $errors = "Token invalide";
            // TODO : Afficher les erreurs
            return $this->render('pages/In/security/change.html.twig', [
                'token' => $changePwd->getToken(),
                'form' => $form->createView(),
            ]);
        }

        return $this->render('pages/In/security/change.html.twig', [
            'token' => $changePwd->getToken(),
            'form' => $form->createView(),
            'errors' => $errors,
        ]);
    }


}