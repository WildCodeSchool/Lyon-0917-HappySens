<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class EmailContact
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("String")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre prénom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre prénom ne contenir moins de  {{ limit }} caractères"
     * )
     *  @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre prénom ne doit pas contenir de chiffre"
     * )
     */
    private $firstName;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("String")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre nom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne contenir moins de  {{ limit }} caractères"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre nom ne doit pas contenir de chiffre"
     * )
     */
    private $lastName;

    /**
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "Votre email : '{{ value }}' n'est pas un email valide.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("String")
     * @Assert\Length(
     *      min = 10,
     *      max = 14,
     *      minMessage = "Le téléphone doit être sous la forme : 00-00-00-00-00",
     *      maxMessage = "Le téléphone doit être sous la forme : 00-00-00-00-00"
     * )
     * *Assert\Regex(
     * *    pattern="/\d/",
     * *    match=false,
     *  *   message="Le téléphone doit être sous la forme : 00-00-00-00-00"
     * *)
     */
    private $phone;

    /**
     * @Assert\Type("String")
     * @Assert\Length(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Le nom de la compagnie doit faire au moins {{ limit }} caractère",
     *      maxMessage = "Votre nom ne contenir moins de  {{ limit }} caractères"
     * )
     */
    private $nameCompany;

    /**
     * @Assert\NotNull(
     *   message="Merci d'indiquer votre statut (Salarié, Entreprise, HappyCoach)"
     * )
     * @Assert\Type("String")
     */
    private $status;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("String")
     * @Assert\Length(
     *      min = 6,
     *      minMessage = "Votre message doit faire au moins {{ limit }} caractères",
     * )
     */
    private $message;

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     * @return EmailContact
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     * @return EmailContact
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return EmailContact
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     * @return EmailContact
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNameCompany()
    {
        return $this->nameCompany;
    }

    /**
     * @param mixed $nameCompany
     * @return EmailContact
     */
    public function setNameCompany($nameCompany)
    {
        $this->nameCompany = $nameCompany;
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
     * @return EmailContact
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     * @return EmailContact
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }





}