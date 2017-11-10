<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Employee;
use AppBundle\Form\EmployeeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InscriptionController extends Controller
{
    /**
     * @Route("/inscription", name="inscription")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function inscriptionAction(Request $request)
    {
        $inscription = new Employee();
        $form = $this->createForm(EmployeeType::class, $inscription);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {

            return $this->redirectToRoute('profilEmploye');
        }
        return $this->render('pages/inscription.html.twig',[
            'form' => $form->createView(),
        ]);
    }

}