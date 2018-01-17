<?php
/**
 * Created by PhpStorm.
 * User: Banb4n
 * Date: 10/01/18
 * Time: 11:41
 */

namespace AppBundle\Command;


use AppBundle\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends ContainerAwareCommand
{
    use LockableTrait;

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure()
    {
        $this->setName('app:createUser');
        $this->setDescription("Take user in threadwaiting and create his profil and send mail with ID connection. ");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $emailContact = $this->getContainer()->getParameter('email_contact');
        $fileUploader = $this->getContainer()->get('AppBundle\Service\FileUploader');
        if($this->lock()) {
            $usersWaiting = $this->em->getRepository('AppBundle:ThreadWaiting')->findOlders();
            $counter = 0;
            foreach($usersWaiting as $user) {
                $userData = $user->getUserData();
                $idComp = $user->getIdComp();
                $user->setIsTrait(true);
                $fileUploader->insertUser(
                    $this->em->find(Company::class, $idComp),
                    $userData,
                    $emailContact
                );
                $counter += 1;
            }
            $output->writeln("$counter user created");
        }

    }
}