<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserHasSkill
 *
 * @ORM\Table(name="user_has_skill")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserHasSkillRepository")
 */
class UserHasSkill
{

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userskills")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, unique=false)
     */
    private $user;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Skill", inversedBy="userskills")
     * @ORM\JoinColumn(name="skill_id", referencedColumnName="id", nullable=false, unique=false)
     */
    private $skill;

    /**
     * @var int
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    private $type;


    /**
     * Set level
     *
     * @param integer $level
     *
     * @return UserHasSkill
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return UserHasSkill
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UserHasSkill
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set skill
     *
     * @param \AppBundle\Entity\Skill $skill
     *
     * @return UserHasSkill
     */
    public function setSkill(\AppBundle\Entity\Skill $skill)
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill
     *
     * @return \AppBundle\Entity\Skill
     */
    public function getSkill()
    {
        return $this->skill;
    }
//
//    public function __toString()
//    {
//
//        $name = $this->getSkill();
//
//        return ''.$name;
//    }

}
