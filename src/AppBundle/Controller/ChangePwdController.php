<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ChangePwd;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Changepwd controller.
 *
 * @Route("changepwd")
 */
class ChangePwdController extends Controller
{
    /**
     * Lists all changePwd entities.
     *
     * @Route("/", name="changepwd_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $changePwds = $em->getRepository('AppBundle:ChangePwd')->findAll();

        return $this->render('changepwd/index.html.twig', array(
            'changePwds' => $changePwds,
        ));
    }

    /**
     * Creates a new changePwd entity.
     *
     * @Route("/new", name="changepwd_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $changePwd = new Changepwd();
        $form = $this->createForm('AppBundle\Form\ChangePwdType', $changePwd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($changePwd);
            $em->flush();

            return $this->redirectToRoute('changepwd_show', array('id' => $changePwd->getId()));
        }

        return $this->render('changepwd/new.html.twig', array(
            'changePwd' => $changePwd,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a changePwd entity.
     *
     * @Route("/{id}", name="changepwd_show")
     * @Method("GET")
     */
    public function showAction(ChangePwd $changePwd)
    {
        $deleteForm = $this->createDeleteForm($changePwd);

        return $this->render('changepwd/show.html.twig', array(
            'changePwd' => $changePwd,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing changePwd entity.
     *
     * @Route("/{id}/edit", name="changepwd_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ChangePwd $changePwd)
    {
        $deleteForm = $this->createDeleteForm($changePwd);
        $editForm = $this->createForm('AppBundle\Form\ChangePwdType', $changePwd);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('changepwd_edit', array('id' => $changePwd->getId()));
        }

        return $this->render('changepwd/edit.html.twig', array(
            'changePwd' => $changePwd,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a changePwd entity.
     *
     * @Route("/{id}", name="changepwd_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ChangePwd $changePwd)
    {
        $form = $this->createDeleteForm($changePwd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($changePwd);
            $em->flush();
        }

        return $this->redirectToRoute('changepwd_index');
    }

    /**
     * Creates a form to delete a changePwd entity.
     *
     * @param ChangePwd $changePwd The changePwd entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ChangePwd $changePwd)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('changepwd_delete', array('id' => $changePwd->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
