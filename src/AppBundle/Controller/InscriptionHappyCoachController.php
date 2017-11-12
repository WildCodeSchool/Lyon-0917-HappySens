<?php

namespace AppBundle\Controller;


use AppBundle\Entity\HappyCoach;
use AppBundle\Form\InscriptionHappyCoachType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request;

class InscriptionHappyCoachController extends Controller
{
    /**
     * @Route("/inscriptionHappyCoach", name="inscriptionHappyCoach")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function inscriptionHappyCoachAction(Request $request)
    {
        $happyCoach = new HappyCoach();
        $form = $this->createForm(InscriptionHappyCoachType::class, $happyCoach);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid())
        {
            return $this->redirectToRoute('profilHappyCoach');
        }
        return $this->render('pages/inscriptionHappyCoach.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}