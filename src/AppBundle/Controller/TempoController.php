<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 29/11/17
 * Time: 15:45
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;



/**
 *
 *
 * @Route("tempo")
 */
class TempoController extends Controller
{
    /**
     * Displays a form to edit an existing company entity.
     *
     * @Route("/{id}/edit", name="newCompany_edit")
     * @Method({"GET", "POST"})
     */
    public function editCompanyAction(Request $request, Company $company)
    {
        $editForm = $this->createForm('AppBundle\Form\CompanyType', $company);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('newCompany_edit', array('id' => $company->getId()));
        }

        return $this->render('pages/In/tempo/editProfil/editCompany.html.twig', array(
            'company' => $company,
            'edit_form' => $editForm->createView(),
        ));
    }

}