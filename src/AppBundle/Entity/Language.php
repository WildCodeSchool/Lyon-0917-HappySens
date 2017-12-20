<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 06/12/17
 * Time: 13:15
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Language
 *
 * @ORM\Table(name="language")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LanguageRepository")
 */
class Language
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=8, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=30, nullable=false)
     */
    private $titreLanguage;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="languagesUser")
     *
     */
    private $users;
    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="nativeLanguage")
     *
     */
    private $nativeUser;

    /**
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="languagesProject")
     *
     */
    private $projects;

    /**
     * @ORM\ManyToMany(targetEntity="Company", mappedBy="languagesCompany")
     *
     */
    private $companies;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
        $this->companies = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Language
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set titreLanguage
     *
     * @param string $titreLanguage
     *
     * @return Language
     */
    public function setTitreLanguage($titreLanguage)
    {
        $this->titreLanguage = $titreLanguage;

        return $this;
    }

    /**
     * Get titreLanguage
     *
     * @return string
     */
    public function getTitreLanguage()
    {
        return $this->titreLanguage;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Language
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return Language
     */
    public function addProject(\AppBundle\Entity\Project $project)
    {
        $this->projects[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \AppBundle\Entity\Project $project
     */
    public function removeProject(\AppBundle\Entity\Project $project)
    {
        $this->projects->removeElement($project);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * Add company
     *
     * @param \AppBundle\Entity\Company $company
     *
     * @return Language
     */
    public function addCompany(\AppBundle\Entity\Company $company)
    {
        $this->companies[] = $company;

        return $this;
    }

    /**
     * Remove company
     *
     * @param \AppBundle\Entity\Company $company
     */
    public function removeCompany(\AppBundle\Entity\Company $company)
    {
        $this->companies->removeElement($company);
    }

    /**
     * Get companies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompanies()
    {
        return $this->companies;
    }

    public function  __toString()
    {
        return $this->getTitreLanguage();
    }

    /**
     * @return mixed
     */
    public function getNativeUser()
    {
        return $this->nativeUser;
    }

    /**
     * @param mixed $nativeUser
     * @return Language
     */
    public function setNativeUser($nativeUser)
    {
        $this->nativeUser = $nativeUser;
        return $this;
    }



    /**
     * Add nativeUser
     *
     * @param \AppBundle\Entity\User $nativeUser
     *
     * @return Language
     */
    public function addNativeUser(\AppBundle\Entity\User $nativeUser)
    {
        $this->nativeUser[] = $nativeUser;

        return $this;
    }

    /**
     * Remove nativeUser
     *
     * @param \AppBundle\Entity\User $nativeUser
     */
    public function removeNativeUser(\AppBundle\Entity\User $nativeUser)
    {
        $this->nativeUser->removeElement($nativeUser);
    }
}
