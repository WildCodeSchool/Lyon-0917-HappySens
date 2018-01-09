<?php
namespace AppBundle\Controller;
use AppBundle\Entity\ChangePwd;
use AppBundle\Form\ChangePwdType;
use AppBundle\Service\CheckSecurityService;
use AppBundle\Service\EmailService;
use Faker\Provider\DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     * @param CheckSecurityService $checkSecurityService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sendChangeAction(Request $request, EmailService $emailService, CheckSecurityService $checkSecurityService)
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
    public function changeAction(ChangePwd $changePwd, Request $request)
    {
        // TODO: Create verif for check if token is valid and desactivate token when is redirect
        $errors = '';
        $sendToken = $request->attributes->get('token');
        $userToken = $changePwd->getToken();
        $form = $this->createForm('AppBundle\Form\EditPasswordType', $changePwd);
        $form->handleRequest($request);

        if ($changePwd->getisActive() === false){
            if ($userToken === $sendToken) {
                $em = $this->getDoctrine()->getManager();
                $changePwd->setIsActive(true);

                // Change password;
                $senderUser = $em->getRepository('AppBundle:User')->findById($changePwd->getIdUser());
                foreach($senderUser as $user) {
                    // Verif formulaire
                    if ($form->isSubmitted() && $form->isValid()) {
                        dump($user->getPassword());
                        dump($request->request);
                    }
                }
            } else {
                $errors = "La page demandé n'existe plus.";
                return $this->render('pages/In/security/login.html.twig', [
                    'errors' => $errors,
                ]);
            }
        } else {
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