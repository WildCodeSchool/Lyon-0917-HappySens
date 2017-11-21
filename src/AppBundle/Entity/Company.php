<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompanyRepository")
 */
class Company
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
     * @ORM\Column(name="activity", type="string", length=100, nullable=true)
     */
    private $activity;

    /**
     * @var int
     *
     * @ORM\Column(name="nbSalary", type="integer", nullable=true)
     */
    private $nbSalary;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="datetime", nullable=true)
     */
    private $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="slogan", type="string", length=255, nullable=true)
     */
    private $slogan;

    /**
     * @var string
     *
     * @ORM\Column(name="quality", type="text")
     */
    private $quality;

    /**
     * @var string
     *
     * @ORM\Column(name="userIdUser", type="string", length=255)
     */
    private $userIdUser;


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
     * Set activity
     *
     * @param string $activity
     *
     * @return Company
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return string
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set nbSalary
     *
     * @param integer $nbSalary
     *
     * @return Company
     */
    public function setNbSalary($nbSalary)
    {
        $this->nbSalary = $nbSalary;

        return $this;
    }

    /**
     * Get nbSalary
     *
     * @return int
     */
    public function getNbSalary()
    {
        return $this->nbSalary;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return Company
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set slogan
     *
     * @param string $slogan
     *
     * @return Company
     */
    public function setSlogan($slogan)
    {
        $this->slogan = $slogan;

        return $this;
    }

    /**
     * Get slogan
     *
     * @return string
     */
    public function getSlogan()
    {
        return $this->slogan;
    }

    /**
     * Set quality
     *
     * @param string $quality
     *
     * @return Company
     */
    public function setQuality($quality)
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * Get quality
     *
     * @return string
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * Set userIdUser
     *
     * @param string $userIdUser
     *
     * @return Company
     */
    public function setUserIdUser($userIdUser)
    {
        $this->userIdUser = $userIdUser;

        return $this;
    }

    /**
     * Get userIdUser
     *
     * @return string
     */
    public function getUserIdUser()
    {
        return $this->userIdUser;
    }
}

