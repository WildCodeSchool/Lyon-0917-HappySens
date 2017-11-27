<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 22/11/17
 * Time: 14:30
 */

namespace AppBundle\DataFixtures\ORM;

use Faker;
use AppBundle\DataFixtures\ORM\LoadCompanyFixtures;
use AppBundle\DataFixtures\ORM\LoadUserHasSkillFixtures;
use AppBundle\DataFixtures\ORM\LoadSkillFixtures;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserFixtures extends Fixture implements FixtureInterface
{
    const MAX = 10;
    public function load(ObjectManager $manager) {


        $faker = Faker\Factory::create("fr_FR");
        $user = [];

        for($i = 0; $i <= self::MAX; $i++) {
            $user[$i] = new User();
            $user[$i]->setFirstName($faker->firstName)
                     ->setLastName($faker->lastName)
                     ->setPhone($faker->phoneNumber)
                     ->setEmail($faker->email)
                     ->setStatus(rand(1,5))
                     ->setBirthdate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()))
                     ->setPhoto($faker->imageUrl("640", "480"))
                     ->setBiography($faker->realText($maxNbChars=255, 2))
                     ->setSlogan($faker->realText($maxNbChars=255, 2))
                     ->setPassword($faker->password(8))
                     ->setMood(rand(1,5))
                     ->setJob($faker->jobTitle)
                     ->setWorkplace($faker->city)
                     ->setNativeLanguage("FR")
                    ->setFacebook($faker->url)
                    ->setTwitter($faker->url)
                    ->setLinkedin($faker->url)
                     ->setLanguage($faker->randomElement($array=["Anglais", "Espagnol", "Russe", "Polonais", "Vietnamien", "Japonais"]));



            $manager->persist($user[$i]);
            $this->addReference("user-" . $i, $user[$i]);

        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
          LoadSkillFixtures::class,
          LoadCompanyFixtures::class,
        );
    }
}