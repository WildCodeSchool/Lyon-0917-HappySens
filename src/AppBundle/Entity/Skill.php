<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Skill
 *
 * @ORM\Table(name="skill")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SkillRepository")
 */
class Skill
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
     * @ORM\Column(name="name_skill", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 10,
     *      minMessage = "Le nom du talent doit contenir au moins plus de {{ limit }} caractères",
     * )
     */
    private $nameSkill;

    /**
     * @ORM\OneToMany(targetEntity="UserHasSkill", mappedBy="skill")
     */
    private $userskills;


    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="theme")
     */
    private $projects;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNameSkill()
    {
        return $this->nameSkill;
    }

    /**
     * @param string $nameSkill
     * @return Skill
     */
    public function setNameSkill($nameSkill)
    {
        $this->nameSkill = $nameSkill;
        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userskills = new \Doctrine\Common\Collections\ArrayCollection();
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add userskill
     *
     * @param \AppBundle\Entity\UserHasSkill $userskill
     *
     * @return Skill
     */
    public function addUserskill(\AppBundle\Entity\UserHasSkill $userskill)
    {
        $userskill->setUser();
        $this->userskills[] = $userskill;

        return $this;
    }

    /**
     * Remove userskill
     *
     * @param \AppBundle\Entity\UserHasSkill $userskill
     */
    public function removeUserskill(\AppBundle\Entity\UserHasSkill $userskill)
    {
        $this->userskills->removeElement($userskill);
    }

    /**
     * Get userskills
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserskills()
    {
        return $this->userskills;
    }

    /**
     * Add project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return Skill
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

    public function __toString()
    {
        return $this->nameSkill;
    }
}
