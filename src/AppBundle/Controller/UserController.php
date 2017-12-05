<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Entity\Company;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserController extends Controller
{


    /**
     * Finds and displays a user entity.
     *
     * @Route("/user/{id}", name="UserProfil")
     * @Method("GET")
     * @Security("user.getIsActive() == true")
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
     * @Route("/mycompany", name="CompanyProfil")
     * @Method("GET")
     * @Security("user.getIsActive() == true")
     *
     */
    public function showCompanyAction()
    {
        /** @var Company $company */
        $company = $this->getUser()->getCompany();
        $nbHappySalarie = count($company->getUsers());
        $em = $this->getDoctrine()->getManager();
        $skillInCompany = $em->getRepository('AppBundle:Company')->getSkillInCompagny($company->getId());
        $refHappySens = $em->getRepository('AppBundle:Company')->getReferentHappySens($company->getId());

            return $this->render('pages/In/company/profilCompany.html.twig', array(
                'company' => $company,
                'nbHappySalarie' => $nbHappySalarie,
                'skillInCompany' => $skillInCompany,
                'refHappySens' => $refHappySens,
            ));


    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/userEdit", name="User_edit")
     * @Method({"GET", "POST"})
     */
    public function editUserAction(Request $request, User $user)
    {
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('User_edit', array('id' => $user->getId()));
        }

        return $this->render('pages/In/collaborators/editUser.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing company entity.
     *
     * @Route("/{id}/companyEdit", name="Company_edit")
     * @Method({"GET", "POST"})
     */
    public function editCompanyAction(Request $request, Company $company)
    {
        $editForm = $this->createForm('AppBundle\Form\CompanyType', $company);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Company_edit', array('id' => $company->getId()));
        }

        return $this->render('pages/In/company/editCompany.html.twig', array(
            'company' => $company,
            'edit_form' => $editForm->createView(),
        ));
    }

}
