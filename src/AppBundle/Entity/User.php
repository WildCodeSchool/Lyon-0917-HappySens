<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    const ROLE_ADMIN = 1;
    const ROLE_COMPANY = 2;
    const ROLE_EMPLOYE = 3;
    const ROLE_HAPPYCOACH = 4;

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
     * @ORM\Column(name="firstName", type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Type("String")
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Votre prénom doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Votre prénom doit contenir moins de  {{ limit }} caractères"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre prénom ne doit pas contenir de chiffre"
     * )
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Type("String")
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Votre nom doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom doit contenir moins de  {{ limit }} caractères"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre nom ne doit pas contenir de chiffre"
     * )
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=30, nullable=true)
     * @Assert\Type("String")
     * @Assert\Length(
     *      min = 10,
     *      max = 14,
     *      minMessage = "Le téléphone doit être sous la forme : 00-00-00-00-00",
     *      maxMessage = "Le téléphone doit être sous la forme : 00-00-00-00-00"
     * )
     * Assert\Regex(
     *     pattern="#^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$#",
     *     match=false,
     *     message="Le téléphone doit être sous la forme : 00-00-00-00-00"
     * )
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=150, unique=true)
     * @Assert\Email(
     *     message = "Votre email : '{{ value }}' n'est pas valide.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     *
     * @ORM\Column(name="birthdate", type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     * @Assert\File(
     *     maxSize = "6016k",
     *     maxSizeMessage = "La taille maximale du fichier est fixée à 5Mo",
     *     mimeTypes = {"image/png", "image/x-png", "image/jpeg", "image/x-jpeg"},
     *     mimeTypesMessage = "Merci de mettre une image valide (format jpeg ou png)"
     * )
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="biography", type="text", nullable=true)
     * @Assert\Length(
     *      min = 10,
     *      minMessage = "Votre message doit contenir au moins plus de {{ limit }} caractères",
     * )
     */
    private $biography;

    /**
     * @var string
     *
     * @ORM\Column(name="slogan", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 10,
     *      max = 255,
     *      minMessage = "Votre slogan doit contenir au moins plus de {{ limit }} caractères",
     *      maxMessage = "Votre slogan ne doit pas contenir plus de {{ limit }} caractères"
     * )
     */
    private $slogan;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var int
     *
     * @ORM\Column(name="mood", type="integer", nullable=true)
     */
    private $mood;

    /**
     *
     * @ORM\Column(name="date_update_mood", type="date", nullable=true)
     */
    private $dateUpdateMood;

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "Votre métier doit contenir au moins plus de {{ limit }} caractères",
     *      maxMessage = "Votre métier ne doit pas contenir plus de {{ limit }} caractères"
     * )
     */
    private $job;

    /**
     * @var string
     *
     * @ORM\Column(name="workplace", type="string", length=100, nullable=true)
     * @Assert\Length(
     *      min = 3,
     *      max = 100,
     *      minMessage = "Le lieu de votre travail doit contenir au moins plus de {{ limit }} caractères",
     *      maxMessage = "Le lieu de votre travail ne doit pas contenir plus de {{ limit }} caractères"
     * )
     */
    private $workplace;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="nativeUser")
     */
    private $nativeLanguage;

    /**
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="users")
     */
    private $company;

    /**
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="likeProjects")
     * @ORM\JoinTable(name="likeProject")
     */
    private $likes;

    /**
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="teamProject")
     * @ORM\JoinTable(name="team")
     */
    private $teams;

    /**
     * @ORM\ManyToMany(targetEntity="Language", inversedBy="users")
     *
     */
    private $languagesUser;

    /**
     * @ORM\OneToMany(targetEntity="UserHasSkill", mappedBy="user", cascade={"persist"})
     */
    private $userskills;

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
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="author")
     */
    private $authorProject;

    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="happyCoach")
     */
    private $happyCoachRef;

    /**
     * @var string
     * @ORM\Column(name="slug", type="string",  length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="NotificationSystem", mappedBy="sender")
     */
    private $sendNotif;

    /**
     * @var int
     */
    private $statusMail;


    public function getSalt()
    {
        return null;
    }

    public function getRoles()
    {
        switch($this->getStatus()) {
            case self::ROLE_ADMIN:
                return array('ROLE_ADMIN');
                break;
            case self::ROLE_COMPANY:
                return array('ROLE_COMPANY');
                break;
            case self::ROLE_EMPLOYE:
                return array('ROLE_EMPLOYE');
                break;
            case self::ROLE_HAPPYCOACH:
                return array('ROLE_HAPPYCOACH');
                break;
            case self::ROLE_HAPPYCOACH_PROJECT:
                return array('ROLE_HAPPYCOACH_PROJECT');
                break;
        }
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            $this->isActive,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            $this->isActive,
            ) = unserialize($serialized);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusMail()
    {
        return $this->statusMail;
    }

    /**
     * @param int $statusMail
     * @return User
     */
    public function setStatusMail($statusMail)
    {
        $this->statusMail = $statusMail;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
     * @param mixed $birthdate
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    public function getAge()
    {
        if($this->birthdate !== null) {
            $today = new \DateTime();
            $age = $this->birthdate->diff($today);

            return $age;
        }
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     * @return User
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return string
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * @param string $biography
     * @return User
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;
        return $this;
    }

    /**
     * @return string
     */
    public function getSlogan()
    {
        return $this->slogan;
    }

    /**
     * @param string $slogan
     * @return User
     */
    public function setSlogan($slogan)
    {
        $this->slogan = $slogan;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return int
     */
    public function getMood()
    {
        return $this->mood;
    }

    /**
     * @param int $mood
     * @return User
     */
    public function setMood($mood)
    {
        $this->mood = $mood;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateUpdateMood()
    {
        return $this->dateUpdateMood;
    }

    /**
     * @param mixed $dateUpdateMood
     * @return User
     */
    public function setDateUpdateMood($dateUpdateMood)
    {
        $this->dateUpdateMood = $dateUpdateMood;
        return $this;
    }

    /**
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @param string $job
     * @return User
     */
    public function setJob($job)
    {
        $this->job = $job;
        return $this;
    }

    /**
     * @return string
     */
    public function getWorkplace()
    {
        return $this->workplace;
    }

    /**
     * @param string $workplace
     * @return User
     */
    public function setWorkplace($workplace)
    {
        $this->workplace = $workplace;
        return $this;
    }

    /**
     * @return string
     */
    public function getNativeLanguage()
    {
        return $this->nativeLanguage;
    }

    /**
     * @param string $nativeLanguage
     * @return User
     */
    public function setNativeLanguage($nativeLanguage)
    {
        $this->nativeLanguage = $nativeLanguage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     * @return User
     */
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param mixed $likes
     * @return User
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * @param mixed $teams
     * @return User
     */
    public function setTeams($teams)
    {
        $this->teams = $teams;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param mixed $skills
     * @return User
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;
        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->likes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->teams = new \Doctrine\Common\Collections\ArrayCollection();
        $this->skills = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add like
     *
     * @param \AppBundle\Entity\Project $like
     *
     * @return User
     */
    public function addLike(\AppBundle\Entity\Project $like)
    {
        $this->likes[] = $like;

        return $this;
    }

    /**
     * Remove like
     *
     * @param \AppBundle\Entity\Project $like
     */
    public function removeLike(\AppBundle\Entity\Project $like)
    {
        $this->likes->removeElement($like);
    }

    /**
     * Add team
     *
     * @param \AppBundle\Entity\Project $team
     *
     * @return User
     */
    public function addTeam(\AppBundle\Entity\Project $team)
    {
        $this->teams[] = $team;

        return $this;
    }

    /**
     * Remove team
     *
     * @param \AppBundle\Entity\Project $team
     */
    public function removeTeam(\AppBundle\Entity\Project $team)
    {
        $this->teams->removeElement($team);
    }


    /**
     * Add userskill
     *
     * @param \AppBundle\Entity\UserHasSkill $userskill
     *
     * @return User
     */
    public function addUserskill(\AppBundle\Entity\UserHasSkill $userskill)
    {
        $userskill->setUser($this);
        $this->userskills[] = $userskill;

        return $this;
    }

    /**
     * Remove userskill
     *
     * @param \AppBundle\Entity\UserHasSkill $userskill
     */
    public function removeUserskill(\AppBundle\Entity\UserHasSkill $userskill)
    {
        $this->userskills->removeElement($userskill);
    }

    /**
     * Get userskills
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserskills()
    {
        return $this->userskills;
    }

    /**
     * @return mixed
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * @param mixed $facebook
     * @return User
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @param mixed $twitter
     * @return User
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }

    /**
     * @param mixed $linkedin
     * @return User
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->email;
    }


    public function __toString()
    {
        return $this->getFirstName() . " " . $this->getLastName();
    }

    /**
     * Set authorProject
     *
     * @param \AppBundle\Entity\Project $authorProject
     *
     * @return User
     */
    public function setAuthorProject(\AppBundle\Entity\Project $authorProject = null)
    {
        $this->authorProject = $authorProject;

        return $this;
    }

    /**
     * Get authorProject
     *
     * @return \AppBundle\Entity\Project
     */
    public function getAuthorProject()
    {
        return $this->authorProject;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return User
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
     * Add languagesUser
     *
     * @param \AppBundle\Entity\Language $languagesUser
     *
     * @return User
     */
    public function addLanguagesUser(\AppBundle\Entity\Language $languagesUser)
    {
        $this->languagesUser[] = $languagesUser;

        return $this;
    }

    /**
     * Remove languagesUser
     *
     * @param \AppBundle\Entity\Language $languagesUser
     */
    public function removeLanguagesUser(\AppBundle\Entity\Language $languagesUser)
    {
        $this->languagesUser->removeElement($languagesUser);
    }

    /**
     * Get languagesUser
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLanguagesUser()
    {
        return $this->languagesUser;
    }

    /**
     * @return mixed
     */
    public function getHappyCoachRef()
    {
        return $this->happyCoachRef;
    }

    /**
     * @param mixed $happyCoachRef
     * @return User
     */
    public function setHappyCoachRef($happyCoachRef)
    {
        $this->happyCoachRef = $happyCoachRef;
        return $this;
    }

    /**
     * Add happyCoachRef
     *
     * @param \AppBundle\Entity\Project $happyCoachRef
     *
     * @return User
     */
    public function addHappyCoachRef(\AppBundle\Entity\Project $happyCoachRef)
    {
        $this->happyCoachRef[] = $happyCoachRef;

        return $this;
    }

    /**
     * Remove happyCoachRef
     *
     * @param \AppBundle\Entity\Project $happyCoachRef
     */
    public function removeHappyCoachRef(\AppBundle\Entity\Project $happyCoachRef)
    {
        $this->happyCoachRef->removeElement($happyCoachRef);
    }

    /**
     * Add sendNotif
     *
     * @param \AppBundle\Entity\NotificationSystem $sendNotif
     *
     * @return User
     */
    public function addSendNotif(\AppBundle\Entity\NotificationSystem $sendNotif)
    {
        $this->sendNotif[] = $sendNotif;

        return $this;
    }

    /**
     * Remove sendNotif
     *
     * @param \AppBundle\Entity\NotificationSystem $sendNotif
     */
    public function removeSendNotif(\AppBundle\Entity\NotificationSystem $sendNotif)
    {
        $this->sendNotif->removeElement($sendNotif);
    }

    /**
     * Get sendNotif
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSendNotif()
    {
        return $this->sendNotif;
    }

    /**
     * Set sendNotif
     *
     * @param \AppBundle\Entity\NotificationSystem $sendNotif
     *
     * @return User
     */
    public function setSendNotif(\AppBundle\Entity\NotificationSystem $sendNotif = null)
    {
        $this->sendNotif = $sendNotif;

        return $this;
    }

    /**
     * Add authorProject
     *
     * @param \AppBundle\Entity\Project $authorProject
     *
     * @return User
     */
    public function addAuthorProject(\AppBundle\Entity\Project $authorProject)
    {
        $this->authorProject[] = $authorProject;

        return $this;
    }

    /**
     * Remove authorProject
     *
     * @param \AppBundle\Entity\Project $authorProject
     */
    public function removeAuthorProject(\AppBundle\Entity\Project $authorProject)
    {
        $this->authorProject->removeElement($authorProject);
    }
}
