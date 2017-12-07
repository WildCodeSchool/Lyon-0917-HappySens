<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Admin
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 */
class Project
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(name="startingDate", type="date")
     */
    private $startingDate;

    /**
     * @ORM\Column(name="endDate", type="date", nullable=true)
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="presentation", type="text")
     */
    private $presentation;

    /**
     * @var string
     *
     * @ORM\Column(name="profit", type="text")
     */
    private $profit;

    /**
     * @var string
     *
     * @ORM\Column(name="beneficeCompany", type="text")
     */
    private $beneficeCompany;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="authorProject")
     */
    private $author;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;


    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=100)
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity="Skill", inversedBy="projects")
     */
    private $theme;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Language", inversedBy="projects")
     *
     */
    private $languagesProject;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="likes")
     * @ORM\JoinTable(name="likeProject")
     */
    private $likeProjects;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="teams")
    * @ORM\JoinTable(name="team")
     */
    private $teamProject;

    /**
     * @var string
     * @ORM\Column(name="slug", type="string",  length=255, nullable=true)
     */
    private $slug;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->languagesProject = new \Doctrine\Common\Collections\ArrayCollection();
        $this->likeProjects = new \Doctrine\Common\Collections\ArrayCollection();
        $this->teamProject = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Project
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set startingDate
     *
     * @param \DateTime $startingDate
     *
     * @return Project
     */
    public function setStartingDate($startingDate)
    {
        $this->startingDate = $startingDate;

        return $this;
    }

    /**
     * Get startingDate
     *
     * @return \DateTime
     */
    public function getStartingDate()
    {
        return $this->startingDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Project
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set presentation
     *
     * @param string $presentation
     *
     * @return Project
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * Get presentation
     *
     * @return string
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * Set profit
     *
     * @param string $profit
     *
     * @return Project
     */
    public function setProfit($profit)
    {
        $this->profit = $profit;

        return $this;
    }

    /**
     * Get profit
     *
     * @return string
     */
    public function getProfit()
    {
        return $this->profit;
    }

    /**
     * Set beneficeCompany
     *
     * @param string $beneficeCompany
     *
     * @return Project
     */
    public function setBeneficeCompany($beneficeCompany)
    {
        $this->beneficeCompany = $beneficeCompany;

        return $this;
    }

    /**
     * Get beneficeCompany
     *
     * @return string
     */
    public function getBeneficeCompany()
    {
        return $this->beneficeCompany;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Project
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Project
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Project
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
     * @return Project
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
     * Set author
     *
     * @param \AppBundle\Entity\User $author
     *
     * @return Project
     */
    public function setAuthor(\AppBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set theme
     *
     * @param \AppBundle\Entity\Skill $theme
     *
     * @return Project
     */
    public function setTheme(\AppBundle\Entity\Skill $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \AppBundle\Entity\Skill
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Add languagesProject
     *
     * @param \AppBundle\Entity\Language $languagesProject
     *
     * @return Project
     */
    public function addLanguagesProject(\AppBundle\Entity\Language $languagesProject)
    {
        $this->languagesProject[] = $languagesProject;

        return $this;
    }

    /**
     * Remove languagesProject
     *
     * @param \AppBundle\Entity\Language $languagesProject
     */
    public function removeLanguagesProject(\AppBundle\Entity\Language $languagesProject)
    {
        $this->languagesProject->removeElement($languagesProject);
    }

    /**
     * Get languagesProject
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLanguagesProject()
    {
        return $this->languagesProject;
    }

    /**
     * Add likeProject
     *
     * @param \AppBundle\Entity\User $likeProject
     *
     * @return Project
     */
    public function addLikeProject(\AppBundle\Entity\User $likeProject)
    {
        $this->likeProjects[] = $likeProject;

        return $this;
    }

    /**
     * Remove likeProject
     *
     * @param \AppBundle\Entity\User $likeProject
     */
    public function removeLikeProject(\AppBundle\Entity\User $likeProject)
    {
        $this->likeProjects->removeElement($likeProject);
    }

    /**
     * Get likeProjects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLikeProjects()
    {
        return $this->likeProjects;
    }

    /**
     * Add teamProject
     *
     * @param \AppBundle\Entity\User $teamProject
     *
     * @return Project
     */
    public function addTeamProject(\AppBundle\Entity\User $teamProject)
    {
        $this->teamProject[] = $teamProject;

        return $this;
    }

    /**
     * Remove teamProject
     *
     * @param \AppBundle\Entity\User $teamProject
     */
    public function removeTeamProject(\AppBundle\Entity\User $teamProject)
    {
        $this->teamProject->removeElement($teamProject);
    }

    /**
     * Get teamProject
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeamProject()
    {
        return $this->teamProject;
    }
}
