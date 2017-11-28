<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $nameSkill;

    /**
     * @ORM\OneToMany(targetEntity="UserHasSkill", mappedBy="skill")
     */
    private $userskills;


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
    public function getNameSkill(): string
    {
        return $this->nameSkill;
    }

    /**
     * @param string $nameSkill
     * @return Skill
     */
    public function setNameSkill(string $nameSkill): Skill
    {
        $this->nameSkill = $nameSkill;
        return $this;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->nameSkill = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add nameSkill
     *
     * @param \AppBundle\Entity\UserHasSkill $nameSkill
     *
     * @return Skill
     */
    public function addNameSkill(\AppBundle\Entity\UserHasSkill $nameSkill)
    {
        $this->nameSkill[] = $nameSkill;

        return $this;
    }

    /**
     * Remove nameSkill
     *
     * @param \AppBundle\Entity\UserHasSkill $nameSkill
     */
    public function removeNameSkill(\AppBundle\Entity\UserHasSkill $nameSkill)
    {
        $this->nameSkill->removeElement($nameSkill);
    }

    /**
     * Add skill
     *
     * @param \AppBundle\Entity\UserHasSkill $skill
     *
     * @return Skill
     */
    public function addSkill(\AppBundle\Entity\UserHasSkill $skill)
    {
        $this->skill[] = $skill;

        return $this;
    }

    /**
     * Remove skill
     *
     * @param \AppBundle\Entity\UserHasSkill $skill
     */
    public function removeSkill(\AppBundle\Entity\UserHasSkill $skill)
    {
        $this->skill->removeElement($skill);
    }

    /**
     * Get skill
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkill()
    {
        return $this->skill;
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
}
