<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Company;
use AppBundle\Form\InscriptionCompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
// use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\Routing\Annotation\Route;

class InscriptionCompanyController extends Controller
{
    /**
     * @Route("/inscriptionCompany", name="inscriptionCompany")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function inscriptionCompanyAction(Request $request){
        $company = new Company();
        $form = $this->createForm(InscriptionCompanyType::class, $company);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()){

            return $this->redirectToRoute('inscriptionCompany2');
        }
        return $this->render('pages/inscriptionCompany.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}