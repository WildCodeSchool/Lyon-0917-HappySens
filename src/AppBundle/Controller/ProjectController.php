<?php

namespace AppBundle\Controller;

use AppBundle\Entity\NewProject;
use AppBundle\Form\NewProjectType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends Controller
{
    /**
     * @Route("/addProject", name="addProject")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function projectAction(Request $request)
    {
        $project = new NewProject();
        $form = $this->createForm(NewProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {

            return $this->redirectToRoute('viewProject');
        }
        return $this->render('pages/addProject.html.twig',[
            'form' => $form->createView(),
        ]);
    }

}