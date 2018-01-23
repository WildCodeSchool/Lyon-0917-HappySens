<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Skill;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Skill controller.
 *
 * @Route("skills")
 */
class SkillController extends Controller
{
    /**
     * Lists all skill entities.
     *
     * @Route("/", name="skills_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $skills = $em->getRepository('AppBundle:Skill')->getNumberProjectForSkill();
        for ($i = 0; $i < count($skills); $i++) {
            $skills[$i]['collaborator'] = $em->getRepository('AppBundle:UserHasSkill')->getNumberUserByTypeForOneSkill('collaborator', $skills[$i]['id']);
            $skills[$i]['happyCoach'] = $em->getRepository('AppBundle:UserHasSkill')->getNumberUserByTypeForOneSkill('happyCoach', $skills[$i]['id']);
        }
        return $this->render('skill/index.html.twig', array(
            'skills' => $skills,
        ));
    }

    /**
     * Creates a new skill entity.
     *
     * @Route("/new", name="skills_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $skill = new Skill();
        $form = $this->createForm('AppBundle\Form\SkillType', $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($skill);
            $em->flush();

            return $this->redirectToRoute('skills_show', array('id' => $skill->getId()));
        }

        return $this->render('skill/new.html.twig', array(
            'skill' => $skill,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a skill entity.
     *
     * @Route("/{id}", name="skills_show")
     * @Method("GET")
     */
    public function showAction(Skill $skill)
    {
        $deleteForm = $this->createDeleteForm($skill);
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:UserHasSkill')->getUsersForOneSkill('collaborator', $skill->getId());
        $happyCoachs = $em->getRepository('AppBundle:UserHasSkill')->getUsersForOneSkill('happyCoach', $skill->getId());
        $projects = $em->getRepository('AppBundle:Project')->getProjectsBySkill($skill->getId());
        return $this->render('skill/show.html.twig', [
            'skill' => $skill,
            'delete_form' => $deleteForm->createView(),
            'users' => $users,
            'happyCoachs' => $happyCoachs,
            'projects' => $projects,
        ]);
    }

    /**
     * Displays a form to edit an existing skill entity.
     *
     * @Route("/{id}/edit", name="skills_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Skill $skill)
    {
        $deleteForm = $this->createDeleteForm($skill);
        $editForm = $this->createForm('AppBundle\Form\SkillType', $skill);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('skills_index');
        }

        return $this->render('skill/edit.html.twig', array(
            'skill' => $skill,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a skill entity.
     *
     * @Route("/{id}", name="skills_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Skill $skill)
    {
        $form = $this->createDeleteForm($skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($skill);
            $em->flush();
        }

        return $this->redirectToRoute('skills_index');
    }

    /**
     * Creates a form to delete a skill entity.
     *
     * @param Skill $skill The skill entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Skill $skill)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('skills_delete', array('id' => $skill->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
