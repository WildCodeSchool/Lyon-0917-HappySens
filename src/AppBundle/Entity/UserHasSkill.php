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
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return UserHasSkill
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSkill()
    {
        return $this->skill;
    }

    /**
     * @param mixed $skill
     * @return UserHasSkill
     */
    public function setSkill($skill)
    {
        $this->skill = $skill;
        return $this;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     * @return UserHasSkill
     */
    public function setLevel(int $level): UserHasSkill
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return UserHasSkill
     */
    public function setType(int $type): UserHasSkill
    {
        $this->type = $type;
        return $this;
    }


}
