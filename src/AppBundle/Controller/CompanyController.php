<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Company controller.
 *
 * @Route("Company")
 */
class CompanyController extends Controller
{


    /**
     * Finds and displays a company entity.
     *
     * @Route("/{id}", name="CompanyProfil")
     * @Method("GET")
     */
    public function showAction(Company $company)
    {

        return $this->render('pages/In/company/profilCompany.html.twig', array(
            'company' => $company,
        ));
    }




}
