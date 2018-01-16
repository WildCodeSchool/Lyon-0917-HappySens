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
    // Constant for nbSalaray => see function getRangeNbSalary()
    const NB_SALARY_50 = 1; // 0-50 salary
    const NB_SALARY_250 = 2; // 51-250 salary
    const NB_SALARY_500 = 3; // 251-500 salary
    const NB_SALARY_MORE_500 = 4; // > 500 salary

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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="nbSalary", type="integer", nullable=true)
     */
    private $nbSalary;


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
     * @ORM\Column(name="three_criteria", type="text")
     */
    private $threeCriteria;

    /**
     *
     * @ORM\Column(name="facebook", type="string",  length=100, nullable=true)
     */
    private $facebook;

    /**
     *
     * @ORM\Column(name="twitter", type="string",  length=100, nullable=true)
     */
    private $twitter;

    /**
     *
     * @ORM\Column(name="linkedin", type="string",  length=100, nullable=true)
     */
    private $linkedin;

    /**
     *
     * @ORM\Column(name="logo", type="string",  length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="company", cascade={"persist"})
     */
    private $users;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=100)
     */
    private $location;

    /**
     * @var string
     * @ORM\Column(name="slug", type="string",  length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="Language", inversedBy="companies")
     *
     */
    private $languagesCompany;

    /**
     * @var string
     */
    private $fileUsers;

    /**
     * @return string
     */
    public function getFileUsers()
    {
        return $this->fileUsers;
    }

    /**
     * @param string $fileUsers
     * @return Company
     */
    public function setFileUsers($fileUsers)
    {
        $this->fileUsers = $fileUsers;
        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->languagesCompany = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Company
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * @return integer
     */
    public function getNbSalary()
    {
        return $this->nbSalary;
    }

    /**
     * Get rangeNbSalary
     *
     * @return integer
     */
    public function getRangeNbSalary()
    {
        $rangeNbSalary='';
        switch($this->nbSalary) {
            case (self::NB_SALARY_50) :
                $rangeNbSalary = ' < 50';
                break;
            case (self::NB_SALARY_250) :
                $rangeNbSalary = '51 - 250';
                break;
            case (self::NB_SALARY_500) :
                $rangeNbSalary = '251 - 500';
                break;
            case (self::NB_SALARY_MORE_500) :
                $rangeNbSalary = ' > 500';
                break;
        }
        return $rangeNbSalary;
    }

    /**
     * @param $birthdate
     * @return $this
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * @return mixed
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
     * Set threeCriteria
     *
     * @param string $threeCriteria
     *
     * @return Company
     */
    public function setThreeCriteria($threeCriteria)
    {
        $this->threeCriteria = $threeCriteria;

        return $this;
    }

    /**
     * Get threeCriteria
     *
     * @return string
     */
    public function getThreeCriteria()
    {
        return $this->threeCriteria;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return Company
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     *
     * @return Company
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set linkedin
     *
     * @param string $linkedin
     *
     * @return Company
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    /**
     * Get linkedin
     *
     * @return string
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Company
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Company
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Company
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Company
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
     * Add languagesCompany
     *
     * @param \AppBundle\Entity\Language $languagesCompany
     *
     * @return Company
     */
    public function addLanguagesCompany(\AppBundle\Entity\Language $languagesCompany)
    {
        $this->languagesCompany[] = $languagesCompany;

        return $this;
    }

    /**
     * Remove languagesCompany
     *
     * @param \AppBundle\Entity\Language $languagesCompany
     */
    public function removeLanguagesCompany(\AppBundle\Entity\Language $languagesCompany)
    {
        $this->languagesCompany->removeElement($languagesCompany);
    }

    /**
     * Get languagesCompany
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLanguagesCompany()
    {
        return $this->languagesCompany;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
