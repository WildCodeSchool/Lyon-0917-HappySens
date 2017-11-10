<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
class EmailContact
{
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;


    /**
     * @var number
     */
    private $phone;

    /**
     * @var string
     */
    private $nameCompany;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $message;


    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return EmailContact
     */
    public function setFirstName(string $firstName): EmailContact
    {
        $this->firstName = $firstName;
        return $this;
    }


    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return EmailContact
     */
    public function setLastName(string $lastName): EmailContact
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return EmailContact
     */
    public function setEmail(string $email): EmailContact
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param number $phone
     * @return EmailContact
     */
    public function setPhone(number $phone): EmailContact
    {
        $this->phone = $phone;
        return $this;
    }

    public function getNameCompany()
    {
        return $this->nameCompany;
    }

    /**
     * @param string $nameCompany
     * @return EmailContact
     */
    public function setNameCompany(string $nameCompany): EmailContact
    {
        $this->nameCompany = $nameCompany;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return EmailContact
     */
    public function setStatus(string $status): EmailContact
    {
        $this->status = $status;
        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return EmailContact
     */
    public function setMessage(string $message): EmailContact
    {
        $this->message = $message;
        return $this;
    }



}