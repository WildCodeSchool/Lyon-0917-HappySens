<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 29/11/17
 * Time: 15:33
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use AppBundle\Entity\User;
use AppBundle\Service\SlugService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 *
 * @Route("admin")
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminController extends Controller
{

    // Traitement Form connection / contact / profils / inscriptions / projets
    /**
     * @Route("/", name="profilAdmin")
     */
    public function profilAdminAction(Request $request)
    {
        return $this->render('pages/In/Admin/profilAdmin.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
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
     * Creates a new company entity.
     *
     * @Route("/newCompany", name="newCompany")
     * @Method({"GET", "POST"})
     */
    public function newCompanyAction(Request $request, SlugService $slugService)
    {
        $company = new Company();
        $form = $this->createForm('AppBundle\Form\CompanyType', $company);
        $form->remove('slug');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $company->setSlug($slugService->slugify($company->getName()));
            $em->persist($company);
            $em->flush();

            return $this->redirectToRoute('CompanyProfil', array('slug' => $company->getSlug()));
        }

        return $this->render('pages/In/Admin/company/new.html.twig', array(
            'company' => $company,
            'form' => $form->createView(),
        ));
    }

    /**
     * Deletes a company entity.
     *
     * @Route("/{slug}", name="Company_delete")
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

        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('pages/In/Admin/collaborators/index.html.twig', array(
            'users' => $users,
        ));
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
     * @Route("/{slug}", name="User_delete")
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

}