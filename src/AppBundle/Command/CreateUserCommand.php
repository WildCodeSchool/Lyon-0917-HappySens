<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 10/01/18
 * Time: 11:41
 */

namespace AppBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Service\autoCheckService;


class CreateUserCommand extends ContainerAwareCommand
{
    private $em;

    use LockableTrait;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure ()
    {
        $this->setName('app:createUser');
        $this->setDescription("Take user in threadwaiting and create his profil and send mail with ID connection. ");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if(!$this->lock()) {
            $autoCheck = new autoCheckService($this->em);
            $nbProjects = $autoCheck->autoFinishProject();
            $output->writeln($nbProjects . ' projets sont maintenant terminés' . PHP_EOL);
        }

    }
}