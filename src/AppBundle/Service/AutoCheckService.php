<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 10/01/18
 * Time: 11:31
 */

namespace AppBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use AppBundle\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;


class AutoCheckService
{
    /** @var ObjectManager */
    private $em;

    /**
     * autoCheckService constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return int
     */
    public function autoFinishProject() {
        $today = new \DateTime();
        $projects = $this->em->getRepository('AppBundle:Project')->getEndDateProjectStatusTwo($today);
        foreach ($projects as $project) {
            $project->setStatus(3);
            $this->em->persist($project);
            $this->em->flush();
        }
        return count($projects);
    }

}

