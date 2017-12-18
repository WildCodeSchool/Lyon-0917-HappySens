<?php
/**
 * Created by PhpStorm.
 * User: banban
 * Date: 17/12/17
 * Time: 20:18
 */

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

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
        $result = [];

        $contentCsv = file_get_contents($file);



        return $result;
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