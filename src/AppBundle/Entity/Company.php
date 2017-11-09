<?php

namespace AppBundle\Entity;


use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToArrayTransformer;
use Symfony\Component\Validator\Constraints\DateTime;

class Company
{
    /**
     * @var string
     */
    private $nameCompany;
    /**
     * @var string
     */
    private $activity;
    /**
     * @var string
     */
    private $address;
    /**
     * @var \DateTime
     */
    private $createDate;
    /**
     * @var string
     */
    private $location;
    /**
     * @var string
     */
    private $nbPeople;
    /**
     * @var string
     */
    private $contactHappySens;
    /**
     * @var string
     */
    private $phoneHappySens;
    /**
     * @var string
     */
    private $emailHappySens;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $confirmationPassword;


    public function getNameCompany()
    {
        return $this->nameCompany;
    }

    /**
     * @param string $nameCompany
     * @return Company
     */
    public function setNameCompany(string $nameCompany): Company
    {
        $this->nameCompany = $nameCompany;

        return $this;
    }


    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * @param string $activity
     * @return Company
     */
    public function setActivity(string $activity): Company
    {
        $this->activity = $activity;

        return $this;
    }


    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Company
     */
    public function setAddress(string $address): Company
    {
        $this->address = $address;

        return $this;
    }


    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @param DateTime $createDate
     * @return Company
     */
    public function setCreateDate(DateTime $createDate): Company
    {
        $this->createDate = $createDate;

        return $this;
    }


    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return Company
     */
    public function setLocation(string $location): Company
    {
        $this->location = $location;

        return $this;
    }


    public function getNbPeople()
    {
        return $this->nbPeople;
    }

    /**
     * @param string $nbPeople
     * @return Company
     */
    public function setNbPeople(string $nbPeople): Company
    {
        $this->nbPeople = $nbPeople;

        return $this;
    }


    public function getContactHappySens()
    {
        return $this->contactHappySens;
    }

    /**
     * @param string $contactHappySens
     * @return Company
     */
    public function setContactHappySens(string $contactHappySens): Company
    {
        $this->contactHappySens = $contactHappySens;

        return $this;
    }


    public function getPhoneHappySens()
    {
        return $this->phoneHappySens;
    }

    /**
     * @param string $phoneHappySens
     * @return Company
     */
    public function setPhoneHappySens(string $phoneHappySens): Company
    {
        $this->phoneHappySens = $phoneHappySens;

        return $this;
    }


    public function getEmailHappySens()
    {
        return $this->emailHappySens;
    }

    /**
     * @param string $emailHappySens
     * @return Company
     */
    public function setEmailHappySens(string $emailHappySens): Company
    {
        $this->emailHappySens = $emailHappySens;

        return $this;
    }


    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Company
     */
    public function setPassword(string $password): Company
    {
        $this->password = $password;

        return $this;
    }


    public function getConfirmationPassword()
    {
        return $this->confirmationPassword;
    }

    /**
     * @param string $confirmationPassword
     * @return Company
     */
    public function setConfirmationPassword(string $confirmationPassword): Company
    {
        $this->confirmationPassword = $confirmationPassword;

        return $this;
    }

}
