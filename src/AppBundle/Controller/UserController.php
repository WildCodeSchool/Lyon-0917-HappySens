<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Company;
use AppBundle\Service\FileUploader;
use AppBundle\Service\StatusProject;
use AppBundle\Service\SlugService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{


    /**
     * Finds and displays a user entity.
     * @Route("/user/{slug}", name="UserProfil")
     * @Method("GET")
     * @Security("user.getIsActive() == true")
     * @param User $user
     * @param StatusProject $statusProject
     * @return mixed
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
        if (null !== count($projects)) {
            $projects = $statusProject->getProjectsWithStatus($projects);
        }

        $company = $this->getUser()->getCompany();

        $pageTrueShowUser = $this->render('pages/In/collaborators/profilEmploye.html.twig', [
            'user' => $user,
            'statusTwig' => $statusTwig,
            'projects' => $projects,
        ]);

        //TODO à tester => redirection à faire pour éviter le message d'erreur
        if ($this->getUser()->getStatus() === User::ROLE_COMPANY or $this->getUser()->getStatus() === User::ROLE_EMPLOYE) {
            if ($company !== $user->getCompany()) {
                throw new AccessDeniedException("tu n'as rien a foutre ici");
            }
            return $pageTrueShowUser;
        }

        //TODO refactor with request
        if ($this->getUser()->getStatus() === User::ROLE_HAPPYCOACH) {
            foreach ($this->getUser()->getHappyCoachRef() as $project) {
                $idAuthor = $project->getAuthor()->getId();
                if ($idAuthor === $user->getId()) {
                    return $pageTrueShowUser;
                }
                $team = $project->getTeamProject();
                foreach ($team as $member) {
                    if ($member->getId() === $user->getId()) {
                        return $pageTrueShowUser;
                    }
                }
            }
            foreach ($this->getUser()->getTeams() as $project) {
                $idAuthor = $project->getAuthor()->getId();
                if ($idAuthor === $user->getId()) {
                    return $pageTrueShowUser;
                }
                $team = $project->getTeamProject();
                foreach ($team as $member) {
                    if ($member->getId() === $user->getId()) {
                        return $pageTrueShowUser;
                    }
                }
                throw new AccessDeniedException("tu n'as rien a foutre ici");
//                return $this->redirectToRoute('profilHappyCoach', array('slug' => $this->getUser()->getSlug()));
            }
        }
        return $pageTrueShowUser;
    }

    /**
     * Finds and displays a company entity.
     *
     * @Route("/company/{slug}", name="CompanyProfil")
     * @Method("GET")
     * @Security("user.getIsActive() == true")
     * @param Company $company
     * @param StatusProject $statusProject
     * @return mixed
     */
    public function showCompanyAction(Company $company, StatusProject $statusProject)
    {
        $user = $this->getUser();
        /** @var Company $company */
        if ($user->getStatus() === User::ROLE_COMPANY or $user->getStatus() === User::ROLE_EMPLOYE) {
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

        // securité pour HappyCoach
        //TODO refactor with request
        if ($user->getStatus() === User::ROLE_HAPPYCOACH) {
            foreach ($user->getHappyCoachRef() as $project) {
                $idCompanyRef = $project->getAuthor()->getCompany()->getId();
                if ($idCompanyRef === $company->getId()) {
                    return $this->render('pages/In/company/profilCompany.html.twig', [
                        'company' => $company,
                        'nbHappySalarie' => $nbHappySalarie,
                        'skillInCompany' => $skillInCompany,
                        'refHappySens' => $refHappySens,
                        'projects' => $projects,]);
                }
            }
            foreach ($user->getTeams() as $project) {
                $idCompanyRef = $project->getAuthor()->getCompany()->getId();
                if ($idCompanyRef === $company->getId()) {
                    return $this->render('pages/In/company/profilCompany.html.twig', [
                        'company' => $company,
                        'nbHappySalarie' => $nbHappySalarie,
                        'skillInCompany' => $skillInCompany,
                        'refHappySens' => $refHappySens,
                        'projects' => $projects,]);
                }
                throw new AccessDeniedException("tu n'as rien a foutre ici");
//                return $this->redirectToRoute('profilHappyCoach', array('slug' => $user->getSlug()));
            }
        }

        return $this->render('pages/In/company/profilCompany.html.twig', [
            'company' => $company,
            'nbHappySalarie' => $nbHappySalarie,
            'skillInCompany' => $skillInCompany,
            'refHappySens' => $refHappySens,
            'projects' => $projects]);
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{slug}/userEdit", name="User_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param User $user
     * @param SlugService $slugService
     * @return mixed
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
            if ($user->getIsActive() == false) {
                $user->setIsActive(1);
            }
            $today = new DateTime();
            $user->setDateUpdateMood($today);
            $this->getDoctrine()->getManager()->flush();

            if ($this->getUser()->getIsActive() == true) {
                return $this->redirectToRoute('UserProfil', array('slug' => $user->getSlug()));

            }
            else {
                return $this->redirectToRoute('User_edit', array('slug' => $user->getSlug()));

            }
        }
        return $this->render('pages/In/collaborators/editUser.html.twig', [
            'user' => $user,
            'edit_form' => $editForm->createView(),]);
    }

    /**
     * Displays a form to edit an existing company entity.
     *
     * @Route("/{slug}/companyEdit", name="Company_edit")
     * @Method({"GET", "POST"})
     */
    public function editCompanyAction(Request $request, Company $company, SlugService $slugService, FileUploader $fileUploader)
    {
        if ($this->getUser()->getStatus() !== 1) {
            $company = $this->getUser()->getCompany();
        }
        $user = $this->getUser();
        $editForm = $this->createForm('AppBundle\Form\editCompanyType', $company);
        $editForm->remove('slug');
        $company->setFileUsers("");
        $editForm->remove('fileUsers');
        $editForm->handleRequest($request);
        if ($user->getStatus() !== 1) {
            if ($user->getStatus() !== 2) {
                throw new AccessDeniedException("Fuis pauvre fou !!");
            }
        }
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if(!empty($editForm['logo']->getData())) {
                unlink($fileUploader->getDirectory("photoCompany") . '/' .$company->getLogo());
                $logo = $editForm['logo']->getData();
                $logoName = $fileUploader->upload($logo, "photoCompany");
                $company->setLogo($logoName);
            }
            $company->setSlug($slugService->slugify($company->getName()));
            $this->getDoctrine()->getManager()->flush();
            if ($this->getUser()->getIsActive() == false || $this->getUser()->getIsActive() !== 1) {
                return $this->redirectToRoute('User_edit', array('slug' => $this->getUser()->getSlug()));
            }
            else {
                return $this->redirectToRoute('CompanyProfil', array('slug' => $company->getSlug()));
            }
        }
        return $this->render('pages/In/company/editCompany.html.twig', [
            'company' => $company,
            'edit_form' => $editForm->createView(),]);
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
        $statusTwig = [];
        $projectsRef = $user->getHappyCoachRef();
        if (null !== count($projectsRef)) {
            $projectsRef = $statusProject->getProjectsWithStatus($projectsRef);
        }
        $projectsTeam = $user->getTeams();
        if (null !== count($projectsTeam)) {
            $projectsTeam = $statusProject->getProjectsWithStatus($projectsTeam);
        }

        $pageTrueShowHappyCoach = $this->render('pages/In/happyCoach/profilHappyCoach.html.twig', [
            'user' => $user,
            'statusTwig' => $statusTwig,
            'projectsRef' => $projectsRef,
            'projectsTeam' => $projectsTeam,]);

        //TODO refactor with request
        if ($this->getUser()->getStatus() === User::ROLE_COMPANY or $this->getUser()->getStatus() === User::ROLE_EMPLOYE) {
            foreach ($user->gethappyCoachRef() as $project) {
                $idAuthor = $project->getAuthor()->getId();
                if ($idAuthor === $this->getUser()->getId()) {
                    return $pageTrueShowHappyCoach;
                }
                $team = $project->getTeamProject();
                foreach ($team as $member) {
                    $idMember = $member->getId();
                    if ($idMember === $this->getUser()->getId()) {
                        return $pageTrueShowHappyCoach;
                    }
                }
            }
                foreach ($user->getTeams() as $projectTeam) {
                    $team = $projectTeam->getTeamProject();
                    foreach ($team as $member) {
                        $idMember = $member->getId();
                        if ($idMember === $this->getUser()->getId()) {
                            return $pageTrueShowHappyCoach;
                        }
                    }
                }
            //TODO change Redirect
            throw new AccessDeniedException("tu n'as rien a foutre ici");
        }

        //TODO refactor with request
        if ($this->getUser()->getStatus() === User::ROLE_HAPPYCOACH and $this->getUser()->getId() != $user->getId()) {
            foreach ($user->getTeams() as $projectTeam) {
                $idHappyCoachRef = $projectTeam->getHappyCoach()->getId();
                if ($idHappyCoachRef === $this->getUser()->getId()) {
                    return $pageTrueShowHappyCoach;
                }
                $team = $projectTeam->getTeamProject();
                foreach ($team as $member) {
                    $idMember = $member->getId();
                    if ($idMember === $this->getUser()->getId()) {
                        return $pageTrueShowHappyCoach;
                    }
                }
            }
            foreach ($this->getUser()->getTeams() as $projectTeam) {
                $idHappyCoachRef = $projectTeam->getHappyCoach()->getId();
                if ($idHappyCoachRef === $user->getId()) {
                    return $pageTrueShowHappyCoach;
                }
            }
            throw new AccessDeniedException("tu n'as rien a foutre ici");
//            return $this->redirectToRoute('profilHappyCoach', array('slug' => $this->getUser()->getSlug()));
        }

        return $pageTrueShowHappyCoach;

    }

    /**
     * Displays a form to update mood.
     *
     * @Route("/updateMood/{slug}", name="updateMood")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param User $user
     * @param SlugService $slugService
     * @return mixed
     */

    public function updateMoodAction(Request $request, User $user, SlugService $slugService)
    {
        $user = $this->getUser();
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->remove('slug')
            ->remove('firstName')
            ->remove('lastName')
            ->remove('phone')
            ->remove('email')
            ->remove('status')
            ->remove('birthdate')
            ->remove('photo')
            ->remove('biography')
            ->remove('slogan')
            ->remove('password')
            ->remove('job')
            ->remove('workplace')
            ->remove('facebook')
            ->remove('twitter')
            ->remove('linkedin')
            ->remove('is_active')
            ->remove('date_update_mood')
            ->remove('nativeLanguage')
            ->remove('company')
            ->remove('languagesUser');
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $today = new \DateTime();
            $user->setDateUpdateMood($today);
            $this->getDoctrine()->getManager()->flush();
            $status = $this->getUser()->getStatus();
            switch ($status) {
                case (User::ROLE_EMPLOYE) :
                    return $this->redirectToRoute('UserProfil', array('slug' => $user->getSlug()));
                    break;
                case (User::ROLE_COMPANY) :
                    return $this->redirectToRoute('CompanyProfil', array('slug' => $user->getCompany()->getSlug()));
                    break;
                case (User::ROLE_HAPPYCOACH) :
                    return $this->redirectToRoute('profilHappyCoach', array('slug' => $user->getSlug()));
                    break;
            }
        }

        return $this->render('user/updateMood.html.twig', [
                'edit_form' => $editForm->createView(),]
        );
    }

}
