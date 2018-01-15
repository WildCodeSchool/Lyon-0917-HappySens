<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ChangePwd;
use AppBundle\Entity\Company;
use AppBundle\Entity\ThreadWaiting;
use AppBundle\Entity\User;
use AppBundle\Service\EmailService;
use AppBundle\Service\FileUploader;
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
     * Get all users of company who are created
     *
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/getUserCreated/", name="ajax_getUserCreated")
     * @Method("POST")
     *
     */
    public function getUserByIdComp(Request $request)
    {
        $errors = "";
        if($request->isXmlHttpRequest()) {
            $idComp = intval($request->request->get('idComp'));
            $usersFind = $this->getDoctrine()->getRepository('AppBundle:ThreadWaiting')->findByIdComp($idComp);
            $userData = "";
            $usersCreated = [];
            foreach($usersFind as $user) {
                $userData = $user->getUserData();
                $usersCreated['email'] = $userData['email'];
                $usersCreated['prenom'] = $userData['prenom'];
                $usersCreated['nom'] = $userData['nom'];
                $usersCreated['isTrait'] = $user->getIstrait();
            }
            return new JsonResponse(['data' => json_encode($usersCreated)]);
        }
        $errors = "Aucun utilisateur trouvé";
        return new JsonResponse(['errors' => json_encode('failed')]);
    }
}
