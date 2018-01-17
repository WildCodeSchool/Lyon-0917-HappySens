<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 29/11/17
 * Time: 15:33
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use AppBundle\Entity\Project;
use AppBundle\Entity\ThreadWaiting;
use AppBundle\Entity\User;
use AppBundle\Entity\UserHasSkill;
use AppBundle\Service\EmailService;
use AppBundle\Service\FileUploader;
use AppBundle\Service\SlugService;
use Doctrine\ORM\Mapping\Id;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 *
 * @Route("admin")
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminController extends Controller
{

    /**
     * @Route("/profil/{slug}", name="profilAdmin")
     */
    public function profilAdminAction()
    {
        $numberUserByStatus['collaborator']['isActif'] = 0;
        $numberUserByStatus['collaborator']['isNotActif'] = 0;
        $numberUserByStatus['collaborator']['total'] = 0;
        $numberUserByStatus['happyCoach']['isActif'] = 0;
        $numberUserByStatus['happyCoach']['isNotActif'] = 0;
        $numberUserByStatus['happyCoach']['total'] = 0;

        $nbProjectsByStatus['1'] = 0;
        $nbProjectsByStatus['2'] = 0;
        $nbProjectsByStatus['3'] = 0;


        $em = $this->getDoctrine()->getManager();
        $getNumberProjectsByStatus = $em->getRepository('AppBundle:Project')->getNumberProjectsByStatus();
        foreach ($getNumberProjectsByStatus as $projectByStatus) {
            switch ($projectByStatus['status']) {
                case(1) :
                    $nbProjectsByStatus['1'] = $projectByStatus['number'];
                    break;
                case(2) :
                    $nbProjectsByStatus['2'] = $projectByStatus['number'];
                    break;
                case(3) :
                    $nbProjectsByStatus['3'] = $projectByStatus['number'];
                    break;
            }
        }
        $getNumberUserByRole = $em->getRepository('AppBundle:User')->getNumberUserByRole();
        foreach ($getNumberUserByRole as $userByStatus) {
            switch ($userByStatus['status']) {
                case (User::ROLE_EMPLOYE) :
                    if ($userByStatus['isActive'] === true) {
                        $numberUserByStatus['collaborator']['isActif'] += $userByStatus['nbUser'];
                    } else {
                        $numberUserByStatus['collaborator']['isNotActif'] += $userByStatus['nbUser'];
                    }
                    $numberUserByStatus['collaborator']['total'] += $userByStatus['nbUser'];
                    break;
                case (User::ROLE_COMPANY) :
                    if ($userByStatus['isActive'] === true) {
                        $numberUserByStatus['collaborator']['isActif'] += $userByStatus['nbUser'];
                    } else {
                        $numberUserByStatus['collaborator']['isNotActif'] += $userByStatus['nbUser'];
                    }
                    $numberUserByStatus['collaborator']['total'] += $userByStatus['nbUser'];
                    break;
                case (User::ROLE_HAPPYCOACH) :
                    if ($userByStatus['isActive'] === true) {
                        $numberUserByStatus['happyCoach']['isActif'] = $userByStatus['nbUser'];
                    } else {
                        $numberUserByStatus['happyCoach']['isNotActif'] = $userByStatus['nbUser'];
                    }
                    $numberUserByStatus['happyCoach']['total'] += $userByStatus['nbUser'];
                    break;
            }
        }
        $nbCompany = $em->getRepository('AppBundle:Company')->getNumberCompany();
        $nbSkills = $em->getRepository('AppBundle:Skill')->getNumberSkill();
        return $this->render('pages/In/Admin/profilAdmin.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'nbProjectsByStatus' => $nbProjectsByStatus,
            'nbUserByStatus' => $numberUserByStatus,
            'nbCompany' => $nbCompany,
            'nbSkill' => $nbSkills
        ]);
    }

    /**
     * Lists all company entities.
     *
     * @Route("/listingCompany", name="listingCompany")
     * @Method("GET")
     */
    public function listingCompanyAction()
    {

        $em = $this->getDoctrine()->getManager();
        $companies = $em->getRepository('AppBundle:Company')->findAll();
        return $this->render('pages/In/Admin/company/index.html.twig', array(
            'companies' => $companies,
        ));

    }

    /**
     * Create new company
     *
     * @param Request $request
     * @param FileUploader $fileUploader
     * @param SlugService $slugService
     * @param EmailService $emailService
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/newCompany", name="newCompany")
     * @Method({"GET", "POST"})
     *
     */
    public function newCompanyAction(Request $request, FileUploader $fileUploader, SlugService $slugService, EmailService $emailService)
    {
        $company = new Company();
        $form = $this->createForm('AppBundle\Form\CompanyType', $company);
        $form->remove('slug');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $myFile = $company->getFileUsers();
            $valuePwd = bin2hex(random_bytes(5));
            $fileName = $fileUploader->upload($myFile, "csvFiles");
            $logo = $company->getLogo();
            $logoName = $fileUploader->upload($logo, "photoCompany");
            $company->setLogo($logoName)
                    ->setFileUsers($fileName)
                    ->setSlug($slugService->slugify($company->getName()));
            $em->persist($company);
            $em->flush();

            $fileUsers = $fileUploader->transformCSV($fileUploader->getDirectory("csvFiles/") . $company->getFileUsers());
            unset($fileUsers[0]);

            $now = new \DateTime('now');
            foreach($fileUsers as $key => $user) {
                $user['key'] = $key;
                $user['valuePwd'] = $valuePwd;
                $thread = new ThreadWaiting();
                $thread->setUserdata($user)
                    ->setIdcomp($company->getId())
                    ->setIstrait(false)
                    ->setDatesend($now->getTimestamp());
                $em->persist($thread);
            }
            $em->flush();

            unlink($fileUploader->getDirectory("csvFiles") . '/' . $company->getFileUsers());
            //TODO change password
            $emailService->sendMailNewCompany($company, $this->container->getParameter('email_contact'), $valuePwd, $fileUsers[1]['email']);

            return $this->redirectToRoute('resume_create_company', array(
                'id' => $company->getId(),
            ));
        }
        return $this->render('pages/In/Admin/company/new.html.twig', array(
            'company' => $company,
            'form' => $form->createView(),
        ));
    }

    /**
     * Recap of creation company.
     *
     * @Route("/resume/{id}/", name="resume_create_company")
     * @Method("GET")
     */
    public function showAction(Request $request, Company $company, FileUploader $fileUploader)
    {
        return $this->render('pages/In/Admin/company/recapNewCompany.html.twig', [
            'company' => $company,
        ]);
    }

    /**
     * Deletes a company entity.
     *
     * @Route("/{slug}/deleteCompany", name="Company_delete")
     * @Method("DELETE")
     */
    public function deleteCompanyAction(Request $request, Company $company)
    {
        $form = $this->createDeleteFormCompany($company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($company);
            $em->flush();
        }

        return $this->redirectToRoute('listingCompany');
    }

    /**
     * Creates a form to delete a company entity.
     *
     * @param Company $company The company entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteFormCompany(Company $company)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Company_delete', array('slug' => $company->getSlug())))
            ->setMethod('DELETE')
            ->getForm();
    }

    //User

    /**
     * Lists all user entities.
     *
     * @Route("/listingUser", name="listingUser")
     * @Method("GET")
     */
    public function listingUserAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->getUserByType('salary');

        return $this->render('pages/In/Admin/collaborators/index.html.twig', [
            'users' => $users,
            'listing' => 'Collaborateur',
            'status' => User::ROLE_EMPLOYE,
        ]);
    }

    /**
     * Lists all user HappyCoach.
     *
     * @Route("/listingHappyCoach", name="listingHappyCoach")
     * @Method("GET")
     */
    public function listingHappyCoachAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->getUserByType('happyCoach');
        return $this->render('pages/In/Admin/collaborators/index.html.twig', [
            'users' => $users,
            'listing' => 'HappyCoach',
            'status' => User::ROLE_HAPPYCOACH,
        ]);
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/newUser/{status}", name="newUser")
     * @Method({"GET", "POST"})
     */
    public function newUserAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, SlugService $slugService, EmailService $emailService, $status)
    {
        $user = new User();

        $form = $this->createForm('AppBundle\Form\NewUserType', $user);
        $form->remove('slug');
        if ($status == User::ROLE_HAPPYCOACH) {
            $form->remove('company')
                ->remove('status');
        }
        $form->handleRequest($request);
        //TODO Password and slugification
        if ($form->isSubmitted() && $form->isValid()) {
            $today = new \DateTime();
            $temp = $today->getTimestamp() - 1515703308; // 1515703308 = Timestamp date created line so 2018/01/12
            $passwordNotEncoder = bin2hex(random_bytes(5));
            $password = $passwordEncoder->encodePassword($user, $passwordNotEncoder);
            if ($status == User::ROLE_HAPPYCOACH) {
                $user->setStatus(User::ROLE_HAPPYCOACH);
            }
            $user->setPassword($password);
            $user->setIsActive(0);
            $user->setSlug($slugService->slugify($user->getFirstName() . ' ' . $user->getLastName() . ' ' . $temp));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $emailService->sendMailNewUser($user, $this->container->getParameter('email_contact'), $passwordNotEncoder);
            return $this->redirectToRoute('profilAdmin', array('slug' => $this->getUser()->getSlug()));
        }

        return $this->render('pages/In/Admin/collaborators/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
            'status' => $status,
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{slug}/deleteUser", name="User_delete")
     * @Method("DELETE")
     */
    public function deleteActionUser(Request $request, User $user)
    {
        $form = $this->createDeleteFormUser($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('listingUser');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteFormUser(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('User_delete', array('slug' => $user->getSlug())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Lists all project entities.
     *
     * @Route("/listingProjects/{status}", name="listingProjects")
     * @Method("GET")
     */
    public function indexAction($status)
    {
        $em = $this->getDoctrine()->getManager();
        $projects = $em->getRepository('AppBundle:Project')->getProjectsByStatus($status);

        return $this->render('pages/In/Admin/projects/index.html.twig', array(
            'projects' => $projects,
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * Add one HappyCoach Ref
     *
     * @Route("/project/{slug}/addHappyCoachRef", name="addHappyCoach")
     * @param Project $project The Project entity
     * @Method({"GET", "POST"})
     */
   public function addHappyCoachRefAction(Request $request, Project $project)
    {

        $editForm = $this->createForm('AppBundle\Form\AddHappyCoachInProjectType', $project);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
               $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profilAdmin', array('slug' => $this->getUser()->getSlug()));
        }
        return $this->render('pages/In/Admin/projects/addHappyCoach.html.twig', [
            'project' => $project,
            'edit_form' => $editForm->createView(),
            ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * Add HappyCoach in team
     *
     * @Route("/project/{slug}/addHappyCoachTeam", name="addHappyCoachTeam")
     * @param Project $project The Project entity
     * @Method({"GET", "POST"})
     */
    public function addHappyCoachTeamAction(Request $request, Project $project)
    {

        $editForm = $this->createForm('AppBundle\Form\AddHappyCoachInTeamType', $project);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profilAdmin', [
                'slug' => $this->getUser()->getSlug(),
                ]);
        }
        return $this->render('pages/In/Admin/projects/addHappyCoach.html.twig', [
            'project' => $project,
            'edit_form' => $editForm->createView(),
        ]);
    }

}
