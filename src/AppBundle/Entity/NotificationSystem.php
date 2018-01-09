<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NotificationSystem
 *
 * @ORM\Table(name="notification_system")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NotificationSystemRepository")
 */
class NotificationSystem
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="sendNotif")
     */
    private $sender;

    /**
     * @var int
     *
     * @ORM\Column(name="idTarget", type="integer")
     */
    private $idTarget;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateSend", type="datetime")
     */
    private $dateSend;

    /**
     * @var bool
     *
     * @ORM\Column(name="isRead", type="boolean")
     */
    private $isRead;


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
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param mixed $sender
     * @return NotificationSystem
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
        return $this;
    }


    /**
     * Set idTarget
     *
     * @param integer $idTarget
     *
     * @return NotificationSystem
     */
    public function setIdTarget($idTarget)
    {
        $this->idTarget = $idTarget;

        return $this;
    }

    /**
     * Get idTarget
     *
     * @return int
     */
    public function getIdTarget()
    {
        return $this->idTarget;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return NotificationSystem
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set dateSend
     *
     * @param \DateTime $dateSend
     *
     * @return NotificationSystem
     */
    public function setDateSend($dateSend)
    {
        $this->dateSend = $dateSend;

        return $this;
    }

    /**
     * Get dateSend
     *
     * @return \DateTime
     */
    public function getDateSend()
    {
        return $this->dateSend;
    }

    /**
     * Set isRead
     *
     * @param boolean $isRead
     *
     * @return NotificationSystem
     */
    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;

        return $this;
    }

    /**
     * Get isRead
     *
     * @return bool
     */
    public function getIsRead()
    {
        return $this->isRead;
    }
}

