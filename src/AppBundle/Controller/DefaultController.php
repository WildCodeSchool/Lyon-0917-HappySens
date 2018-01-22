<?php

namespace AppBundle\Controller;

use AppBundle\Service\EmailService;
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
        return $this->render('pages/Out/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("company", name="company")
     */
    public function companyAction(Request $request)
    {
        return $this->render('pages/Out/company.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("collaborators", name="collaborators")
     */
    public function employeAction(Request $request)
    {
        return $this->render('pages/Out/employe.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("happyCoach", name="happyCoach")
     */
    public function happyAction(Request $request)
    {
        return $this->render('pages/Out/happyCoach.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("cgv", name="cgv")
     */
    public function cgvAction(Request $request)
    {
        return $this->render('pages/Out/cgv.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("viewProject", name="viewProject")
     */
    public function recapProjectAction(Request $request)
    {
        return $this->render('project/viewProject.html.twig', [
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

// TODO : Supprimer la route avant de faire la mise en prod
    /**
     * @Route("test", name="listingTemplate")
     */
    public function testAction(Request $request, EmailService $mail)
        {
////            $test = $this->getDoctrine()->getManager()->getRepository('AppBundle:Project')->find(1);
//        $test = realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR;
//
//            dump($test);

            return $this->render('testStepForm.html.twig');
        }
}
