<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
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
     * @var string
     *
     * @ORM\Column(name="likeUserIdUser", type="string", length=255)
     */
    private $likeUserIdUser;

    /**
     * @var string
     *
     * @ORM\Column(name="likeProjectIdProject", type="string", length=255)
     */
    private $likeProjectIdProject;

    /**
     * @var string
     *
     * @ORM\Column(name="teamUserIdUser", type="string", length=255)
     */
    private $teamUserIdUser;

    /**
     * @var string
     *
     * @ORM\Column(name="teamProjectIdProject", type="string", length=255)
     */
    private $teamProjectIdProject;


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
     * Set author
     *
     * @param string $author
     *
     * @return Project
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set likeUserIdUser
     *
     * @param string $likeUserIdUser
     *
     * @return Project
     */
    public function setLikeUserIdUser($likeUserIdUser)
    {
        $this->likeUserIdUser = $likeUserIdUser;

        return $this;
    }

    /**
     * Get likeUserIdUser
     *
     * @return string
     */
    public function getLikeUserIdUser()
    {
        return $this->likeUserIdUser;
    }

    /**
     * Set likeProjectIdProject
     *
     * @param string $likeProjectIdProject
     *
     * @return Project
     */
    public function setLikeProjectIdProject($likeProjectIdProject)
    {
        $this->likeProjectIdProject = $likeProjectIdProject;

        return $this;
    }

    /**
     * Get likeProjectIdProject
     *
     * @return string
     */
    public function getLikeProjectIdProject()
    {
        return $this->likeProjectIdProject;
    }

    /**
     * Set teamUserIdUser
     *
     * @param string $teamUserIdUser
     *
     * @return Project
     */
    public function setTeamUserIdUser($teamUserIdUser)
    {
        $this->teamUserIdUser = $teamUserIdUser;

        return $this;
    }

    /**
     * Get teamUserIdUser
     *
     * @return string
     */
    public function getTeamUserIdUser()
    {
        return $this->teamUserIdUser;
    }

    /**
     * Set teamProjectIdProject
     *
     * @param string $teamProjectIdProject
     *
     * @return Project
     */
    public function setTeamProjectIdProject($teamProjectIdProject)
    {
        $this->teamProjectIdProject = $teamProjectIdProject;

        return $this;
    }

    /**
     * Get teamProjectIdProject
     *
     * @return string
     */
    public function getTeamProjectIdProject()
    {
        return $this->teamProjectIdProject;
    }
}

