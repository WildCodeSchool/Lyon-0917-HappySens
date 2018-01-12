<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ChangePwd;
use AppBundle\Entity\Company;
use AppBundle\Entity\User;
use AppBundle\Service\EmailService;
use AppBundle\Service\FileUploader;
use SensioLabs\Security\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;



/**
 *
 * @Route("ajax")
 */
class AjaxController extends Controller
{
    const ROLE_ADMIN = User::ROLE_ADMIN;
    const ROLE_COMPANY = User::ROLE_COMPANY;
    const ROLE_EMPLOYE = User::ROLE_EMPLOYE;

    /**
     * Create user when add a new company
     *
     * @param Request $request
     * @param FileUploader $fileUploader
     * @param EmailService $emailService
     * @return JsonResponse
     *
     * @Route("/addUser/", name="ajax_adduser")
     * @Method("POST")
     *
     */
    public function createUser(Request $request, FileUploader $fileUploader, EmailService $emailService)
    {
        $errors = '';
        $fileUsers['nom'] = $request->request->get('nom');
        $fileUsers['prenom'] = $request->request->get('prenom');
        $fileUsers['email'] = $request->request->get('email');

        if($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $key = $request->request->get('key');
            $idCompany = $request->request->get('idComp');

            $arrayUsers = $fileUploader->insertUser(
                "1234",
                $em->find(Company::class, $idCompany),
                $fileUsers,
                $this->container->getParameter('email_contact'),
                $emailService,
                ($key <= self::ROLE_ADMIN) ? self::ROLE_COMPANY : self::ROLE_EMPLOYE,
                $key
            );
            return new JsonResponse(['data' => json_encode($arrayUsers)]);
        } else {
            $errors = "500, Erreur lors de l'envoi de la requête";
            return new JsonResponse(['errors' => $errors, 'data' => json_encode($fileUsers)]);
        }
    }
}
