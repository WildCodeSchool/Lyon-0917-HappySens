<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Company;
use AppBundle\Service\StatusProject;
use AppBundle\Service\SlugService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{


    /**
     * Finds and displays a user entity.
     *
     * @Route("/user/{slug}", name="UserProfil")
     * @Method("GET")
     * @Security("user.getIsActive() == true")
     */
    public function showUserAction(User $user, StatusProject $statusProject)
    {

            if (null !== $user->getAuthorProject()) {
                $contact = $user->getAuthorProject()->getStatus();
                $statusTwig = $statusProject->getStatusTwig($contact);
            } else {
                $statusTwig = [];
            }
            $projects = $user->getTeams();
            for ($i = 0; $i < count($projects); $i++) {
                $twigStatus = $statusProject->getStatusTwig($projects[$i]->getStatus());
                $projects[$i]->setStatus(['class' => $twigStatus['class'], 'text' => $twigStatus['text']]);
            }
            $company = $this->getUser()->getCompany();

            if ($this->getUser()->getStatus() !== 1) {
                if ($company !== $user->getCompany()) {
                    throw new AccessDeniedException("tu n'as rien a foutre ici");
                }

                return $this->render('pages/In/collaborators/profilEmploye.html.twig', array('user' => $user, 'statusTwig' => $statusTwig, 'projects' => $projects));

            }
            return $this->render('pages/In/collaborators/profilEmploye.html.twig', array('user' => $user, 'statusTwig' => $statusTwig, 'projects' => $projects));

    }

    /**
     * Finds and displays a company entity.
     *
     * @Route("/company/{slug}", name="CompanyProfil")
     * @Method("GET")
     * @Security("user.getIsActive() == true")
     *
     */
    public function showCompanyAction(Company $company, StatusProject $statusProject)
    {
        $user = $this->getUser();
        /** @var Company $company */
        if ($user->getStatus() !== 1) {
            $company = $this->getUser()->getCompany();
        }
        $nbHappySalarie = count($company->getUsers());
        $em = $this->getDoctrine()->getManager();
        $skillInCompany = $em->getRepository('AppBundle:Company')->getSkillInCompagny($company->getId());
        $refHappySens = $em->getRepository('AppBundle:Company')->getReferentHappySens($company->getId());
        $projects = $em->getRepository('AppBundle:Company')->getProjectsInCompany($company->getId());

        if (count($projects) > 0) {
            for ($i = 0; $i < count($projects); $i++) {
                $project = $em->getRepository('AppBundle:Project')->findBy(array('id' => $projects[$i]['id']));
                $projects[$i]['nbLike'] = count($project[0]->getLikeProjects());
                $twigStatus = $statusProject->getStatusTwig($projects[$i]['status']);
                $projects[$i]['status'] =  $twigStatus;
            }
        }
        return $this->render('pages/In/company/profilCompany.html.twig', array('company' => $company, 'nbHappySalarie' => $nbHappySalarie, 'skillInCompany' => $skillInCompany, 'refHappySens' => $refHappySens, 'projects' => $projects));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{slug}/userEdit", name="User_edit")
     * @Method({"GET", "POST"})
     */
    public function editUserAction(Request $request, User $user, SlugService $slugService)
    {


        if ($this->getUser()->getStatus() !== 1) {
            $user = $this->getUser();
        }
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->remove('slug');
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $user->setSlug($slugService->slugify($user->getFirstName() . $user->getLastName()));
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('User_edit', array('slug' => $user->getSlug()));
        }
        return $this->render('pages/In/collaborators/editUser.html.twig', array('user' => $user, 'edit_form' => $editForm->createView(),));
    }

    /**
     * Displays a form to edit an existing company entity.
     *
     * @Route("/{slug}/companyEdit", name="Company_edit")
     * @Method({"GET", "POST"})
     */
    public function editCompanyAction(Request $request, Company $company, SlugService $slugService)
    {
        if ($this->getUser()->getStatus() !== 1) {
            $company = $this->getUser()->getCompany();
        }
        $user = $this->getUser();
        $editForm = $this->createForm('AppBundle\Form\CompanyType', $company);
        $editForm->remove('slug');
        $editForm->remove('fileUsers');
        $editForm->handleRequest($request);
        if ($user->getStatus() !== 1) {
            if ($user->getStatus() !== 2) {
                throw new AccessDeniedException("Fuis pauvre fou !!");
            }
        }
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $company->setSlug($slugService->slugify($company->getName()));
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('Company_edit', array('slug' => $company->getSlug()));
        }
        return $this->render('pages/In/company/editCompany.html.twig', array('company' => $company, 'edit_form' => $editForm->createView()));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("happycoach/{slug}", name="profilHappyCoach")
     * @Method("GET")
     * @Security("user.getIsActive() == true")
     */
    public function showHappyCoachAction(User $user, StatusProject $statusProject)
    {

        if ($this->getUser()->getStatus() === 4) {
            $statusTwig = [];
            $projects = $user->getHappyCoachRef();
            $slug = $user->getSlug();
            if (null !== count($projects)) {
                if (count($projects) === 1) {
                    $contact = $user->getHappyCoachRef()->getStatus();
                    $statusTwig = $statusProject->getStatusTwig($contact);
                } else {
                    for ($i = 0; $i < count($projects); $i++) {
                        $twigStatus = $statusProject->getStatusTwig($projects[$i]->getStatus());
                        $projects[$i]->setStatus(['class' => $twigStatus['class'], 'text' => $twigStatus['text']]);
                        $statusTwig = [];
                    }
                }
            }
            return $this->render('pages/In/happyCoach/profilHappyCoach.html.twig', array('user' => $user, 'statusTwig' => $statusTwig, 'projects' => $projects, 'slug' => $slug));
        }
    }

}
