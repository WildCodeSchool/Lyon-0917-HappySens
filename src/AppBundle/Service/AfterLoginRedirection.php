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
                $redirection = new RedirectResponse($this->router->generate('profilAdmin', array('slug' => $user->getSlug())));
            } elseif (in_array('ROLE_EMPLOYE', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('User_edit', array('slug' => $user->getSlug())));
            } elseif (in_array('ROLE_COMPANY', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('Company_edit', array('slug' => $user->getCompany()->getSlug())));
            } elseif (in_array('ROLE_HAPPYCOACH', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('profilHappyCoach', array('slug' => $user->getSlug())));
            }
        } else {
            if (in_array('ROLE_ADMIN', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('profilAdmin', array('slug' => $user->getSlug())));
            } elseif (in_array('ROLE_EMPLOYE', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('UserProfil', array('slug' => $user->getSlug())));
            } elseif (in_array('ROLE_COMPANY', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('CompanyProfil', array('slug' => $user->getCompany()->getSlug())));
            } elseif (in_array('ROLE_HAPPYCOACH', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('profilHappyCoach', array('slug' => $user->getSlug())));
            } else {
                $redirection = new RedirectResponse($this->router->generate('User_edit', array('slug' => $user->getSlug())));
            }
        }
        return $redirection;
    }
}