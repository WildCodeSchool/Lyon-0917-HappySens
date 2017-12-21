<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\User;
use AppBundle\Service\SlugService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Admin controller.
 *
 * @Route("project")
 */
class ProjectController extends Controller
{


    /**
     * Creates a new project entity.
     *
     * @Route("/new", name="project_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, SlugService $slugService)
    {
        $project = new Project();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $form = $this->createForm('AppBundle\Form\ProjectType', $project);
        $form->remove('author');
        $form->remove('startingDate');
        $form->remove('status');
        $form->remove('photo');
        $form->remove('likeProjects');
        $form->remove('teamProject');
        $project->setStartingDate(DateTime::createFromFormat ('d/m/Y', date('d/m/Y') ));
        $project->setStatus(1);
        $form->remove('slug');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $project->setEndDate(DateTime::createFromFormat ('d/m/Y', $project->getEndDate() ));
            $em = $this->getDoctrine()->getManager();
            $project->setSlug($slugService->slugify($project->getTitle()));
            $project->setAuthor($user);
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('project_show', array('slug' => $project->getSlug()));
        }

        return $this->render('project/new.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a project entity.
     *
     * @Route("/{slug}", name="project_show")
     * @Method("GET")
     */
    public function showAction(Project $project)
    {
        $deleteForm = $this->createDeleteForm($project);
        $nbLikes = count($project->getLikeProjects());

        return $this->render('project/show.html.twig', array(
            'project' => $project,
            'nbLike' => $nbLikes,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing project entity.
     *
     * @Route("/{slug}/edit", name="project_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Project $project, SlugService $slugService)
    {
        $deleteForm = $this->createDeleteForm($project);
        $editForm = $this->createForm('AppBundle\Form\ProjectType', $project);
        $editForm->remove('author');
        $editForm->remove('status');
        $editForm->remove('photo');
        $editForm->remove('likeProjects');
        $editForm->remove('teamProject');
        $editForm->remove('slug');
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $project->setSlug($slugService->slugify($project->getTitle()));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('project_edit', array('slug' => $project->getSlug()));
        }

        return $this->render('project/edit.html.twig', array(
            'project' => $project,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a project entity.
     *
     * @Route("/{slug}", name="project_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Project $project)
    {
        $form = $this->createDeleteForm($project);
        $form->remove('author');
        $form->remove('status');
        $form->remove('photo');
        $form->remove('likeProjects');
        $form->remove('teamProject');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($project);
            $em->flush();
        }

        return $this->redirectToRoute('project_index');
    }

    /**
     * Creates a form to delete a project entity.
     *
     * @param Project $project The project entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Project $project)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('project_delete', array('slug' => $project->getSlug())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/joinTeam/{slug}/", name="join_team")
     *
     */
    // TODO: AJAX
    public function joinAction(Request $request, Project $project)
    {
        $idU = $this->getUser();
        $add = $project->addTeamProject($idU);
        $em = $this->getDoctrine()->getManager();
        $em->persist($add);
        $em->flush();
        return $this->redirectToRoute('project_show', array('slug' => $project->getSlug()));
    }

    /**
     * @Route("/quitTeam/{slug}/", name="quit_team")
     *
     */
    // TODO: AJAX
    public function quitAction(Request $request, Project $project)
    {
        $idU = $this->getUser();
        $rm = $project->removeTeamProject($idU);
        $em = $this->getDoctrine()->getManager();
        $em->persist($rm);
        $em->flush();
        return $this->redirectToRoute('project_show', array('slug' => $project->getSlug()));
    }


    /**
     * @Route("/likeProject/{slug}/", name="like_project")
     *
     */
    // TODO: AJAX
    public function likeAction(Request $request, Project $project)
    {
        $idU = $this->getUser();
        $add = $project->addLikeProject($idU);
        $em = $this->getDoctrine()->getManager();
        $em->persist($add);
        $em->flush();
        return $this->redirectToRoute('project_show', array('slug' => $project->getSlug()));
    }

    /**
     * @Route("/unlikeProject/{slug}/", name="unlike_project")
     *
     */
    // TODO: AJAX
    public function unlikeAction(Request $request, Project $project)
    {
        $idU = $this->getUser();
        $add = $project->removeLikeProject($idU);
        $em = $this->getDoctrine()->getManager();
        $em->persist($add);
        $em->flush();
        return $this->redirectToRoute('project_show', array('slug' => $project->getSlug()));
    }
}
