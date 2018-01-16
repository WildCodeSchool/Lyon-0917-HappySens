<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 5,
     *      max = 255,
     *      minMessage = "Le titre de votre projet doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Le titre de votre projet ne doit pas contenir plus de {{ limit }} caractères"
     *      )
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
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 10,
     *      minMessage = "Votre message doit contenir au moins plus de {{ limit }} caractères",
     * )
     */
    private $presentation;

    /**
     * @var string
     *
     * @ORM\Column(name="profit", type="text")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 10,
     *      minMessage = "Votre message doit contenir au moins plus de {{ limit }} caractères",
     * )
     */
    private $profit;

    /**
     * @var string
     *
     * @ORM\Column(name="beneficeCompany", type="text")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 10,
     *      minMessage = "Votre message doit contenir au moins plus de {{ limit }} caractères",
     * )
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
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 3,
     *      max = 100,
     *      minMessage = "Le lieu de votre projet doit contenir plus de {{ limit }} caractères",
     *      maxMessage = "Le lieu de votre projet ne doit pas contenir plus de {{ limit }} caractères"
     * )
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity="Skill", inversedBy="projects")
     * @Assert\NotNull(
     *   message = "Thème non sélectionné"
     * )
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
     * @ORM\OneToOne(targetEntity="User", inversedBy="happyCoachRef")
     */
    private $happyCoach;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Project
     */
    public function setId($id)
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
    public function setTitle($title)
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
    public function setStartingDate(\DateTime $startingDate)
    {
        $this->startingDate = $startingDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     * @return Project
     */
    public function setEndDate( $endDate)
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
    public function setPresentation($presentation)
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
    public function setProfit($profit)
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
    public function setBeneficeCompany($beneficeCompany)
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
    public function setAuthor($author)
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

        return $this;
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

        return $this;
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

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Project
     */
    public function setSlug(string $slug): Project
    {
        $this->slug = $slug;
        return $this;
    }


    public function __toString()
    {
        return $this->getTitle() . " " . $this->getAuthor();
    }

    /**
     * @return mixed
     */
    public function getHappyCoach()
    {
        return $this->happyCoach;
    }

    /**
     * @param mixed $happyCoach
     * @return Project
     */
    public function setHappyCoach($happyCoach)
    {
        $this->happyCoach = $happyCoach;
        return $this;
    }




    /**
     * Add happyCoach
     *
     * @param \AppBundle\Entity\User $happyCoach
     *
     * @return Project
     */
    public function addHappyCoach(\AppBundle\Entity\User $happyCoach)
    {
        $this->happyCoach[] = $happyCoach;

        return $this;
    }

    /**
     * Remove happyCoach
     *
     * @param \AppBundle\Entity\User $happyCoach
     */
    public function removeHappyCoach(\AppBundle\Entity\User $happyCoach)
    {
        $this->happyCoach->removeElement($happyCoach);
    }
}
