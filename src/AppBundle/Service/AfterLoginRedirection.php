<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 01/12/17
 * Time: 13:35
 */
namespace AppBundle\Service;

use AppBundle\Entity\Company;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;


class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{

    private $router;

    /**
     * AfterLoginRedirection constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param Request        $request
     *
     * @param TokenInterface $token
     *
     * @return RedirectResponse
     */

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {

        $roles = $token->getRoles();
        $user = $token->getUser();
        $active = array('active' => $user->getIsActive());

        $rolesTab = array_map(function ($role) {
            return $role->getRole();
        }, $roles);

        if($active['active'] == false) {
            if (in_array('ROLE_ADMIN', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('profilAdmin', array('id' => $user->getId())));
            } elseif (in_array('ROLE_EMPLOYE', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('User_edit', array('id' => $user->getId())));
            } elseif (in_array('ROLE_COMPANY', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('Company_edit', array('id' => $user->getCompany()->getId())));
            } elseif (in_array('ROLE_HAPPYCOACH', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('profilHappyCoach', array('id' => $user->getId())));
            }
        } else {
            if (in_array('ROLE_ADMIN', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('profilAdmin', array('id' => $user->getId())));
            } elseif (in_array('ROLE_EMPLOYE', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('UserProfil', array('id' => $user->getId())));
            } elseif (in_array('ROLE_COMPANY', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('CompanyProfil', array('id' => $user->getCompany()->getId())));
            } elseif (in_array('ROLE_HAPPYCOACH', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('UserProfil', array('id' => $user->getId())));
            } else {
                $redirection = new RedirectResponse($this->router->generate('User_edit', array('id' => $user->getId())));
            }
        }
        return $redirection;
    }
}