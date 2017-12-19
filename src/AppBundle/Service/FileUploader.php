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
    private $directory;

    private $db;

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

    public function __construct(RegistryInterface $db, $directory)
    {

        $this->directory = $directory;
        $this->db = $db;
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

    public function insertUser($valueMdp, $idCompany, $fileUsers)
    {
        // for destroy twins
        $listEmails = [];
        $slugService = new SlugService();

        for($i = 0; $i < count($fileUsers); $i++) {
            if (!in_array($fileUsers[$i][2], $listEmails)) {
                $newUser = new User();
                $newUser->setFirstName($fileUsers[$i][0]);
                $newUser->setLastName($fileUsers[$i][1]);
                $newUser->setEmail($fileUsers[$i][2]);
                $newUser->setPassword(password_hash($valueMdp, PASSWORD_BCRYPT));
                $newUser->setStatus(3);
                $newUser->setMood(0);
                $newUser->setIsActive(0);
                $newUser->setCompany($idCompany);
                $newUser->setSlug($slugService->slugify($newUser->getFirstName() . ' ' . $newUser->getLastName()));
                $listEmails[$i] = $fileUsers[$i][2];
                $this->getDb()->getManager()->persist($newUser);
            }
        }
        $this->getDb()->getManager()->flush();

        return " utilisateurs sont créés";
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