<?php

namespace AppBundle\Entity;


use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\File;

class NewProject
{
    /**
     * @var string
     */
    private $nameProject;

    /**
     * @var string
     */
    private $location;

    /**
     * @var DateTime
     */
    private $dateStart;

    /**
     * @var DateTime
     */
    private $dateEnd;

    /**
     * @var string
     */
    private $theme;

    /**
     * @var string
     */
    private $languages;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $advantagesCompany;

    /**
     * @var string
     */
    private $advantagesGroup;

    /**
     * @var File
     */
    private $uploadPicture;

    /**
     * @return string
     */
    public function getNameProject()
    {
        return $this->nameProject;
    }

    /**
     * @param string $nameProject
     * @return NewProject
     */
    public function setNameProject($nameProject)
    {
        $this->nameProject = $nameProject;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return NewProject
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param DateTime $dateEnd
     * @return NewProject
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * @param DateTime $dateStart
     * @return NewProject
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;
        return $this;
    }

    /**
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param string $theme
     * @return NewProject
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @param string $languages
     * @return NewProject
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return NewProject
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdvantagesCompany()
    {
        return $this->advantagesCompany;
    }

    /**
     * @param string $advantagesCompany
     * @return NewProject
     */
    public function setAdvantagesCompany($advantagesCompany)
    {
        $this->advantagesCompany = $advantagesCompany;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdvantagesGroup()
    {
        return $this->advantagesGroup;
    }

    /**
     * @param string $advantagesGroup
     * @return NewProject
     */
    public function setAdvantagesGroup($advantagesGroup)
    {
        $this->advantagesGroup = $advantagesGroup;
        return $this;
    }

    /**
     * @return File
     */
    public function getUploadPicture()
    {
        return $this->uploadPicture;
    }

    /**
     * @param File $uploadPicture
     * @return NewProject
     */
    public function setUploadPicture($uploadPicture)
    {
        $this->uploadPicture = $uploadPicture;
        return $this;
    }
}