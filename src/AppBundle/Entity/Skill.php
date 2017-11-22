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
     *
     * @ORM\OneToMany(targetEntity="UserHasSkill", mappedBy="skill")
     */
    private $nameSkill;


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
}
