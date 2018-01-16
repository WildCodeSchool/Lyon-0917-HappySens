<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Company;
use AppBundle\Entity\UserHasSkill;
use AppBundle\Service\EmailService;
use AppBundle\Service\FileUploader;
use AppBundle\Service\StatusProject;
use AppBundle\Service\SlugService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Email;

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
                throw new AccessDeniedException("Vous n'êtes pas autorisé à vous rendre sur cette page");
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
                throw new AccessDeniedException("Vous n'êtes pas autorisé à vous rendre sur cette page");
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


        $em = $this->getDoctrine()->getManager();
        $nbHappySalarie = $em->getRepository('AppBundle:Company')->getNumberCollaboratorHasActif($company->getId());
        $skillInCompany = $em->getRepository('AppBundle:Company')->getSkillInCompagny($company->getId());
        $refHappySens = $em->getRepository('AppBundle:Company')->getReferentHappySens($company->getId());
        $projects = $em->getRepository('AppBundle:Company')->getProjectsInCompany($company->getId());
        $collaborators = $em->getRepository('AppBundle:Company')->getAllCollaboratorInCompany($company->getId());
        shuffle($collaborators);

        if (count($projects) > 0) {
            for ($i = 0; $i < count($projects); $i++) {
                $project = $em->getRepository('AppBundle:Project')->findBy(array('id' => $projects[$i]['id']));
                $projects[$i]['nbLike'] = count($project[0]->getLikeProjects());
                $twigStatus = $statusProject->getStatusTwig($projects[$i]['status']);
                $projects[$i]['status'] =  $twigStatus;
            }
        }

        $trueViewCompany = $this->render('pages/In/company/profilCompany.html.twig', [
            'company' => $company,
            'nbHappySalarie' => $nbHappySalarie,
            'skillInCompany' => $skillInCompany,
            'refHappySens' => $refHappySens,
            'projects' => $projects,
            'collaborators' => $collaborators,
            ]);


        // securité pour HappyCoach
        //TODO refactor with request
        if ($user->getStatus() === User::ROLE_HAPPYCOACH) {
            foreach ($user->getHappyCoachRef() as $project) {
                $idCompanyRef = $project->getAuthor()->getCompany()->getId();
                if ($idCompanyRef === $company->getId()) {
                    return $trueViewCompany;
                }
            }
            foreach ($user->getTeams() as $project) {
                $idCompanyRef = $project->getAuthor()->getCompany()->getId();
                if ($idCompanyRef === $company->getId()) {
                    return $trueViewCompany;
                }
                throw new AccessDeniedException("Vous n'êtes pas autorisé à vous rendre sur cette page");
//                return $this->redirectToRoute('profilHappyCoach', array('slug' => $user->getSlug()));
            }
        }

        return $trueViewCompany;
    }

    /**
     * Displays a form to edit an existing user entity :
     * ROLE_COMPANY, ROLE_EMPLOYE and ROLE_HAPPYCOACH.
     *
     * @Route("/{slug}/userEdit", name="User_edit")
     *
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param User $user
     * @param SlugService $slugService
     * @return mixed
     */
    public function editUserAction(Request $request, User $user, SlugService $slugService, FileUploader $fileUploader,
                                   UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($this->getUser()->getStatus() !== User::ROLE_ADMIN) {
            $user = $this->getUser();
        }

        $photoTemp = $user->getPhoto();
        if ($user->getPhoto() !== NULL) {
            $user->setPhoto(
                new File($this->getParameter('upload_directory').'/photoUser/'.$user->getPhoto())
            );
            $photoTempEntire = $user->getPhoto();
        }

        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->remove('slug');
        $editForm->remove('user');
        $editForm->remove('company');
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if ($editForm->getData()->getPhoto() !== NULL) {
                if (isset($photoTempEntire)) {
                    unlink($photoTempEntire);
                }
                $file = $user->getPhoto();
                $fileName = $fileUploader->upload($file, "photoUser");
                $user->setPhoto($fileName);
            } else {
                $user->setPhoto($photoTemp);
            }
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $user->setSlug($slugService->slugify($user->getFirstName() . $user->getLastName()));
            if ($user->getIsActive() == false) {
                $user->setIsActive(1);
            }
            $today = new \DateTime();
            $user->setDateUpdateMood($today);
            $this->getDoctrine()->getManager()->flush();

            if ($this->getUser()->getIsActive() == true) {
                if ($user->getStatus() == User::ROLE_EMPLOYE or $user->getStatus() == User::ROLE_COMPANY) {
                    return $this->redirectToRoute('UserProfil', array('slug' => $user->getSlug()));
                }
                if ($user->getStatus() == User::ROLE_HAPPYCOACH) {
                    return $this->redirectToRoute('profilHappyCoach', array('slug' => $user->getSlug()));
                }
                if ($user->getStatus() == User::ROLE_ADMIN) {
                    return $this->redirectToRoute('profilAdmin', array('slug' => $user->getSlug()));
                }
            } else {
                return $this->redirectToRoute('User_edit', array('slug' => $user->getSlug()));

            }
        }
        return $this->render('pages/In/collaborators/editUser.html.twig', [
            'user' => $user,
            'edit_form' => $editForm->createView(),
            ]);
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
            if (!empty($editForm['logo']->getData())) {
                unlink($fileUploader->getDirectory("photoCompany") . '/' . $company->getLogo());
                $logo = $editForm['logo']->getData();
                $logoName = $fileUploader->upload($logo, "photoCompany");
                $company->setLogo($logoName);
            }
            $company->setSlug($slugService->slugify($company->getName()));
            $this->getDoctrine()->getManager()->flush();
            if ($this->getUser()->getIsActive() == false || $this->getUser()->getIsActive() !== 1) {
                return $this->redirectToRoute('User_edit', array('slug' => $this->getUser()->getSlug()));
            } else {
                return $this->redirectToRoute('CompanyProfil', array('slug' => $company->getSlug()));
            }
        }
        return $this->render('pages/In/company/editCompany.html.twig', [
            'company' => $company,
            'edit_form' => $editForm->createView(),
            ]);
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
        $nbProject = 0;
        if (null !== count($projectsRef)) {
            $projectsRef = $statusProject->getProjectsWithStatus($projectsRef);
            $nbProject += count($projectsRef);
        }
        $projectsTeam = $user->getTeams();
        if (null !== count($projectsTeam)) {
            $projectsTeam = $statusProject->getProjectsWithStatus($projectsTeam);
            $nbProject += count($projectsTeam);
        }

        $pageTrueShowHappyCoach = $this->render('pages/In/happyCoach/profilHappyCoach.html.twig', [
            'user' => $user,
            'statusTwig' => $statusTwig,
            'projectsRef' => $projectsRef,
            'projectsTeam' => $projectsTeam,
            'nbProject' => $nbProject,]);

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
            throw new AccessDeniedException("Vous n'êtes pas autorisé à vous rendre sur cette page");
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
            throw new AccessDeniedException("Vous n'êtes pas autorisé à vous rendre sur cette page");
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
        $editForm = $this->createForm('AppBundle\Form\MoodType', $user);
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
    /**
     * Creates a new collaborater entity.
     *
     * @Route("/newCollaborater", name="newCollaborater")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_COMPANY')")
     */
    public function newActionUser(Request $request, UserPasswordEncoderInterface $passwordEncoder, SlugService $slugService, EmailService $emailService)
    {
        $company = $this->getUser()->getCompany();

        $user = new User();

        $form = $this->createForm('AppBundle\Form\NewUserType', $user);
        $form->remove('status');
        $form->remove('company');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $today = new \DateTime();
            $temp = $today->getTimestamp() - 1515703308; // 1515703308 = Timestamp date created line so 2018/01/12
            $passwordNotEncoder = bin2hex(random_bytes(5));
            $password = $passwordEncoder->encodePassword($user, $passwordNotEncoder);
            $user->setPassword($password);
            $user->setStatus(User::ROLE_EMPLOYE);
            $user->setIsActive(0);
            $user->setCompany($company);
            $user->setSlug($slugService->slugify($user->getFirstName() . ' ' . $user->getLastName() . ' ' . $temp));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $emailService->sendMailNewUser($user, $this->container->getParameter('email_contact'), $passwordNotEncoder);

            return $this->redirectToRoute('UserProfil', array('slug' => $user->getSlug()));
        }


        return $this->render('pages/In/company/newCollaborater.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }


}
