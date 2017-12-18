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
use Symfony\Component\HttpFoundation\File\UploadedFile;
use AppBundle\Service\SlugService;

class FileUploader
{
    private $targetDirectory;

    public function __construct()
    {
        $this->targetDirectory = $this->getTargetDirectory();
    }

    public function upload(UploadedFile $file, $directory)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $this->setTargetDirectory($directory);

        $file->move($this->getTargetDirectory(), $fileName);

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
        $users = $fileUsers;
        $slug = new SlugService();
        for($i = 0; $i < count($users); $i++) {
            foreach ($users as $key => $user) {
                $newUser = new User();
                $newUser->setFirstName($user[0]);
                $newUser->setLastName($user[1]);
                $newUser->setEmail($user[2]);
                $newUser->setPassword(password_hash($valueMdp, PASSWORD_BCRYPT));
                $newUser->setStatus(3);
                $newUser->setIsActive(0);
                $newUser->setCompany($idCompany);
                $newUser->setSlug($slug->slugify($newUser->getFirstName() . ' ' . $newUser->getLastName()));
            }
        }
        return $newUser;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }

    public function setTargetDirectory($directory)
    {
        return $this->targetDirectory  = "uploads/$directory";
    }
}