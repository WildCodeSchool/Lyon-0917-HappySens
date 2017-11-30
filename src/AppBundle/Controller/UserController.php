<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Company;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends Controller
{


    /**
     * Finds and displays a user entity.
     *
     * @Route("/user/{id}", name="UserProfil")
     * @Method("GET")
     */
    public function showUserAction(User $user)
    {

        return $this->render('pages/In/collaborators/profilEmploye.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * Finds and displays a company entity.
     *
     * @Route("/company/{id}", name="CompanyProfil")
     * @Method("GET")
     */
    public function showCompanyAction(Company $company)
    {

        return $this->render('pages/In/company/profilCompany.html.twig', array(
            'company' => $company,
        ));
    }


}
