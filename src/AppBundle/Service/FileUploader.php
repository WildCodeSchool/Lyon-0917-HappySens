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

class FileUploader
{
    const MAIL_OK = 1;

    const MAIL_FAIL = 0;
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
     * FileUploader constructor.
     * @param RegistryInterface $db
     * @param $directory
     */
    public function __construct(RegistryInterface $db, $directory)
    {

        $this->directory = $directory;
        $this->db = $db;
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

    public function upload(UploadedFile $file, $underDir)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->getDirectory($underDir), $fileName);

        return $fileName;
    }

    public function transformCSV($file)
    {
        $csv = array_map('str_getcsv', file($file));
// This is for have value for key like [name] => dupond
//    array_walk($csv, function(&$a) use ($csv) {
//        $a = array_combine($csv[0], $a);
//    });
        return $csv;
    }

    public function insertUser($valueMdp, $idCompany, $fileUsers, $email_contact, EmailService $emailService)
    {
        // for destroy twins
        $listEmails = [];
        $arrayUsers = [];
        $slugService = new SlugService();

        for($i = 0; $i < count($fileUsers); $i++) {
            if (!in_array($fileUsers[$i][2], $listEmails)) {
                $newUser = new User();

                $newUser->setFirstName($fileUsers[$i][0])
                        ->setLastName($fileUsers[$i][1])
                        ->setEmail($fileUsers[$i][2])
                        ->setPassword(password_hash($valueMdp, PASSWORD_BCRYPT))
                        ->setMood(0)
                        ->setSlug($slugService->slugify($newUser->getFirstName() . ' ' . $newUser->getLastName()))
                        ->setCompany($idCompany)
                        ->setIsActive(0);
                if ($i === 0) {
                    $newUser->setStatus(2);
                } else {
                    $newUser->setStatus(3);
                }
                $listEmails[$i] = $fileUsers[$i][2];
                $this->setCounter(($this->getCounter() + 1));

                $emailService->sendMailNewUser($newUser, $email_contact, $valueMdp);
                $newUser->setStatusMail(self::MAIL_OK);
                $arrayUsers[$i] = $newUser;
                $this->getDb()->getManager()->persist($newUser);
            }
        }
        $this->getDb()->getManager()->flush();

        return $arrayUsers;
    }

    public function getDirectory($underDir)
    {
        return $this->directory . '/' . $underDir;
    }

    public function setDirectory($directory)
    {
        return $this->directory  = $directory;
    }
}