<?php
/**
 * Created by PhpStorm.
 * User: banban
 * Date: 17/12/17
 * Time: 20:18
 */

namespace AppBundle\Service;

use AppBundle\AppBundle;
use AppBundle\Entity\User;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use AppBundle\Service\SlugService;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class FileUploader
{
    const CREATE_OK = 1;

    const CREATE_FAIL = 0;
    /**
     * @var string
     */
    private $directory;

    /**
     * @var RegistryInterface
     */
    private $db;

    /**
     * @var int
     */
    private $counter = 0;

    /**
     * @var EmailService
     */
    private $emailService;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * FileUploader constructor.
     * @param RegistryInterface $db
     * @param $directory
     * @param EmailService $emailService
     */
    public function __construct(RegistryInterface $db, $directory, EmailService $emailService,  UserPasswordEncoderInterface $passwordEncoder)
    {

        $this->directory = $directory;
        $this->db = $db;
        $this->emailService = $emailService;
        $this->passwordEncoder = $passwordEncoder;

    }

    /**
     * @return mixed
     */
    public function getCounter()
    {
        return $this->counter;
    }

    /**
     * @param mixed $counter
     * @return FileUploader
     */
    public function setCounter($counter)
    {
        $this->counter = $counter;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     * @return FileUploader
     */
    public function setDb($db)
    {
        $this->db = $db;
        return $this;
    }

    /**
     * @param UploadedFile $file
     * @param $underDir
     * @return string
     */
    // TODO : Create const for underDir and switch with all types of uploads with verif
    public function upload(UploadedFile $file, $underDir)
    {
        $fileName = md5(uniqid()).'.'. $file->guessExtension();

        $file->move($this->getDirectory($underDir), $fileName);

        return $fileName;
    }

    /**
     * @param $file
     * @return array
     */
    public function transformCSV($file)
    {
        $csv = array_map('str_getcsv', file($file));
// This is for have value for key like [name] => dupond
        array_walk($csv, function(&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });
        return $csv;
    }

    /**
     * @param $idCompany
     * @param $fileUsers
     * @param $email_contact
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return int
     */
    public function insertUser($idCompany, $fileUsers, $email_contact)
    {
        $slugService = new SlugService();
        $newUser = new User();

        if (!empty($fileUsers)) {
            $newUser->setFirstName($fileUsers['prenom'])
                ->setLastName($fileUsers['nom'])
                ->setEmail($fileUsers['email'])
                ->setPassword($this->passwordEncoder->encodePassword($newUser, $fileUsers['valuePwd']))
                ->setMood(0)
                ->setSlug($slugService->slugify($newUser->getFirstName() . ' ' . $newUser->getLastName()))
                ->setCompany($idCompany)
                ->setIsActive(0);
            $newUser->setStatus(($fileUsers['key'] <= 1) ? User::ROLE_COMPANY : User::ROLE_EMPLOYE);

            $this->getDb()->getManager()->persist($newUser);
            $this->emailService->sendMailNewUser($newUser, $email_contact, $fileUsers['valuePwd']);
            $newUser->setStatusMail(1);
            $this->getDb()->getManager()->flush();

            return self::CREATE_OK;
        } else {
            return self::CREATE_FAIL;
        }
    }

    /**
     * @param $underDir
     * @return string
     */
    public function getDirectory($underDir)
    {
        return $this->directory . '/' . $underDir;
    }

    /**
     * @param $directory
     * @return mixed
     */
    public function setDirectory($directory)
    {
        return $this->directory  = $directory;
    }
}