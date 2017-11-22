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
     * @ORM\OneToMany(targetEntity="User", mappedBy="skills")
     */
    private $users;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Skill", inversedBy="nameSkill")
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserHasSkill
     */
    public function setId(int $id): UserHasSkill
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsers(): string
    {
        return $this->users;
    }

    /**
     * @param string $users
     * @return UserHasSkill
     */
    public function setUsers(string $users): UserHasSkill
    {
        $this->users = $users;
        return $this;
    }

    /**
     * @return string
     */
    public function getSkill(): string
    {
        return $this->skill;
    }

    /**
     * @param string $skill
     * @return UserHasSkill
     */
    public function setSkill(string $skill): UserHasSkill
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


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->skill = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UserHasSkill
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
     * Add skill
     *
     * @param \AppBundle\Entity\Skill $skill
     *
     * @return UserHasSkill
     */
    public function addSkill(\AppBundle\Entity\Skill $skill)
    {
        $this->skill[] = $skill;

        return $this;
    }

    /**
     * Remove skill
     *
     * @param \AppBundle\Entity\Skill $skill
     */
    public function removeSkill(\AppBundle\Entity\Skill $skill)
    {
        $this->skill->removeElement($skill);
    }
}
