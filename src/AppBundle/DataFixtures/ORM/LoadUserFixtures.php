<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 22/01/18
 * Time: 21:44
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserFixtures extends Fixture implements FixtureInterface
{

    public function load(ObjectManager $manager)
 {
     $firstName = 'Laetitia';
     $lastName = 'Ferrer';
     $password = '$2y$13$kwLdU/kISw/aC/zU2sogA.3dJ9jSNkJubypo9YEGVh0uISG683F4i';
     $user = new User();
     $user->setFirstName($firstName)
         ->setLastName($lastName)
         ->setEmail('famar.wcslyon@gmail.com')
         ->setStatus(User::ROLE_ADMIN)
         ->setPassword($password)
         ->setTwitter('https://twitter.com/L3FERRER')
         ->setLinkedin('https://www.linkedin.com/in/laetitiaferrer/')
         ->setWorkplace('Lyon')
         ->setMood(5)
         ->setDateUpdateMood(new \DateTime())
         ->setSlug('laetitiaferrer')
         ->setIsActive(1);
     $manager->persist($user);
     $manager->flush();
 }
}