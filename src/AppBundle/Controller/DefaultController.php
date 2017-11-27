<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homeAction(Request $request)
    {
        return $this->render('pages/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("company", name="company")
     */
    public function companyAction(Request $request)
    {
        return $this->render('pages/company.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("employe", name="employe")
     */
    public function employeAction(Request $request)
    {
        return $this->render('pages/employe.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("happyCoach", name="happyCoach")
     */
    public function happyAction(Request $request)
    {
        return $this->render('pages/happyCoach.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("cgv", name="cgv")
     */
    public function cgvAction(Request $request)
    {
        return $this->render('pages/cgv.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("viewProject", name="viewProject")
     */
    public function recapProjectAction(Request $request)
    {
        return $this->render('pages/viewProject.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    // Profil
    /**
     * @Route("profilEmploye", name="profilEmploye")
     */
    public function profilEmployeAction(Request $request)
    {
        return $this->render('pages/profilEmploye.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("profilCompany", name="profilCompany")
     */
    public function profilCompanyAction(Request $request)
    {
        return $this->render('pages/profilCompany.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("profilHappyCoach", name="profilHappyCoach")
     */
    public function profilHappyCoachAction(Request $request)
    {
        return $this->render('pages/profilHappyCoach.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("listingNotifications", name="listingNotifications")
     */
    public function listingNotificationsAction(Request $request)
    {
        return $this->render('pages/listingNotifications.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    // Traitement Form connection / contact / profils / inscriptions / projets
    /**
     * @Route("profilAdmin", name="profilAdmin")
     */
    public function profilAdminAction(Request $request)
    {
        return $this->render('pages/profilAdmin.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    // Traitement Form connection / contact / profils / inscriptions / projets
    /**
     * @Route("test", name="listingTemplate")
     */
    public function testAction(Request $request)
    {
        return $this->render('pages/template/templates_listing.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
