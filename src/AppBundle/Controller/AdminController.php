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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
    public function profilAdminAction(Request $request)
    {
        $nbProjectsByStatus = [];
        $nbUserByStatus = [];
        $nbSkills = [];
        $em = $this->getDoctrine()->getManager();
        $nbProjectsByStatus = $em->getRepository('AppBundle:Project')->getNumberProjectsByStatus();
        $nbUserByStatus = $em->getRepository('AppBundle:User')->getNumberUserByRole();
        $nbCompany = $em->getRepository('AppBundle:Company')->getNumberCompany();
        $nbSkills = $em->getRepository('AppBundle:Skill')->getNumberSkill();

        return $this->render('pages/In/Admin/profilAdmin.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'nbProjectsByStatus' => $nbProjectsByStatus,
            'nbUserByStatus' => $nbUserByStatus,
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
//        unlink($fileUploader->getDirectory("csvFiles") . '/' .$company->getFileUsers());
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

            $emailService->sendMailNewCompany($company, $this->container->getParameter('email_contact'), '1234', $fileUsers[1]['email']);

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
dump($users);
        return $this->render('pages/In/Admin/collaborators/index.html.twig', [
            'users' => $users,
            'listing' => 'HappyCoach',
        ]);
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/newUser", name="newUser")
     * @Method({"GET", "POST"})
     */
    public function newActionUser(Request $request, UserPasswordEncoderInterface $passwordEncoder, SlugService $slugService)
    {
        $user = new User();


        $form = $this->createForm('AppBundle\Form\UserType', $user);
        $form->remove('slug');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $user->setSlug($slugService->slugify($user->getFirstName() . ' ' . $user->getLastName()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('newUser_show', array('slug' => $user->getSlug()));
        }


        return $this->render('pages/In/Admin/collaborators/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
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
            ->getForm()
            ;
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

}