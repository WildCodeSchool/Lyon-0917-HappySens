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
     * @var \DateTime
     *
     * @ORM\Column(name="startingDate", type="datetime")
     */
    private $startingDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime", nullable=true)
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
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
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
     * @ORM\Column(name="photo", type="string", length=255)
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Project
     */
    public function setId(int $id): Project
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Project
     */
    public function setTitle(string $title): Project
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartingDate()
    {
        return $this->startingDate;
    }

    /**
     * @param \DateTime $startingDate
     * @return Project
     */
    public function setStartingDate(\DateTime $startingDate): Project
    {
        $this->startingDate = $startingDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     * @return Project
     */
    public function setEndDate(\DateTime $endDate): Project
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * @param string $presentation
     * @return Project
     */
    public function setPresentation(string $presentation): Project
    {
        $this->presentation = $presentation;
        return $this;
    }

    /**
     * @return string
     */
    public function getProfit()
    {
        return $this->profit;
    }

    /**
     * @param string $profit
     * @return Project
     */
    public function setProfit(string $profit): Project
    {
        $this->profit = $profit;
        return $this;
    }

    /**
     * @return string
     */
    public function getBeneficeCompany()
    {
        return $this->beneficeCompany;
    }

    /**
     * @param string $beneficeCompany
     * @return Project
     */
    public function setBeneficeCompany(string $beneficeCompany): Project
    {
        $this->beneficeCompany = $beneficeCompany;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return Project
     */
    public function setAuthor(string $author): Project
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLikeProjects()
    {
        return $this->likeProjects;
    }

    /**
     * @param mixed $likeProjects
     * @return Project
     */
    public function setLikeProjects($likeProjects)
    {
        $this->likeProjects = $likeProjects;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTeamProject()
    {
        return $this->teamProject;
    }

    /**
     * @param mixed $teamProject
     * @return Project
     */
    public function setTeamProject($teamProject)
    {
        $this->teamProject = $teamProject;
        return $this;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->likeProjects = new \Doctrine\Common\Collections\ArrayCollection();
        $this->teamProject = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return Project
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     * @return Project
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     * @return Project
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param mixed $theme
     * @return Project
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
        return $this;
    }


}
