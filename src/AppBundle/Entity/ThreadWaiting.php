<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ThreadWaiting
 *
 * @ORM\Table(name="thread_waiting")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ThreadWaitingRepository")
 */
class ThreadWaiting
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
     * @var array
     *
     * @ORM\Column(name="userdata", type="array")
     */
    private $userdata;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datesend", type="datetime")
     */
    private $datesend;

    /**
     * @var int
     *
     * @ORM\Column(name="idcomp", type="integer")
     */
    private $idcomp;

    /**
     * @var bool
     *
     * @ORM\Column(name="istrait", type="boolean")
     */
    private $istrait;


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
     * Set userdata
     *
     * @param array $userdata
     *
     * @return ThreadWaiting
     */
    public function setUserdata($userdata)
    {
        $this->userdata = $userdata;

        return $this;
    }

    /**
     * Get userdata
     *
     * @return array
     */
    public function getUserdata()
    {
        return $this->userdata;
    }

    /**
     * Set datesend
     *
     * @param \DateTime $datesend
     *
     * @return ThreadWaiting
     */
    public function setDatesend($datesend)
    {
        $this->datesend = $datesend;

        return $this;
    }

    /**
     * Get datesend
     *
     * @return \DateTime
     */
    public function getDatesend()
    {
        return $this->datesend;
    }

    /**
     * Set idcomp
     *
     * @param integer $idcomp
     *
     * @return ThreadWaiting
     */
    public function setIdcomp($idcomp)
    {
        $this->idcomp = $idcomp;

        return $this;
    }

    /**
     * Get idcomp
     *
     * @return int
     */
    public function getIdcomp()
    {
        return $this->idcomp;
    }

    /**
     * Set istrait
     *
     * @param boolean $istrait
     *
     * @return ThreadWaiting
     */
    public function setIstrait($istrait)
    {
        $this->istrait = $istrait;

        return $this;
    }

    /**
     * Get istrait
     *
     * @return bool
     */
    public function getIstrait()
    {
        return $this->istrait;
    }
}

