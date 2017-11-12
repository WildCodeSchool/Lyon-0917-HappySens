<?php

namespace AppBundle\Entity;


class HappyCoach
{
    /**
     * @var string
     */
    private $firstname;
    /**
     * @var string
     */
    private $lastname;
    /**
     * @var string
     */
    private $address;
    /**
     * @var string
     */
    private $activity;
    /**
     * @var string
     */
    private $phone;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $confirmationPassword;


    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return HappyCoach
     */
    public function setFirstname(string $firstname): HappyCoach
    {
        $this->firstname = $firstname;

        return $this;
    }


    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return HappyCoach
     */
    public function setLastname(string $lastname): HappyCoach
    {
        $this->lastname = $lastname;

        return $this;
    }


    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return HappyCoach
     */
    public function setAddress(string $address): HappyCoach
    {
        $this->address = $address;

        return $this;
    }


    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * @param string $activity
     * @return HappyCoach
     */
    public function setActivity(string $activity): HappyCoach
    {
        $this->activity = $activity;

        return $this;
    }


    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return HappyCoach
     */
    public function setPhone(string $phone): HappyCoach
    {
        $this->phone = $phone;

        return $this;
    }


    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return HappyCoach
     */
    public function setEmail(string $email): HappyCoach
    {
        $this->email = $email;

        return $this;
    }


    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return HappyCoach
     */
    public function setPassword(string $password): HappyCoach
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
     * @return HappyCoach
     */
    public function setConfirmationPassword(string $confirmationPassword): HappyCoach
    {
        $this->confirmationPassword = $confirmationPassword;

        return $this;
    }

}