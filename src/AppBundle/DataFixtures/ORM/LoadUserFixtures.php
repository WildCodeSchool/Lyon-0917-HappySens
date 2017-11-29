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
    const ROLE = [
        1 => 1,
        2 => 5,
        3 => 25,
        4 => 5,
        5 => 4,
        6 => 5
    ];

    public function load(ObjectManager $manager) {


        $faker = Faker\Factory::create("fr_FR");
        $user = [];
        $nbUser = 0;
        foreach (self::ROLE as $key => $role) {
            for ($i = 0; $i < $role; $i++) {
                $user[$nbUser] = new User();
                $user[$nbUser]->setFirstName($faker->firstName)
                    ->setLastName($faker->lastName)
                    ->setPhone($faker->phoneNumber)
                    ->setEmail($faker->email)
                    ->setStatus($key)
                    ->setBirthdate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()))
                    ->setPhoto($faker->imageUrl("150", "150"))
                    ->setBiography($faker->realText($maxNbChars = 255, 2))
                    ->setSlogan($faker->realText($maxNbChars = 255, 2))
                    ->setPassword('azerty1234')
                    ->setMood(rand(1, 5))
                    ->setJob($faker->jobTitle)
                    ->setWorkplace($faker->city)
                    ->setNativeLanguage("FR")
                    ->setFacebook($faker->url)
                    ->setTwitter($faker->url)
                    ->setLinkedin($faker->url)
                    ->setLanguage($faker->randomElement($array = ["Anglais", "Espagnol", "Russe", "Polonais", "Vietnamien", "Japonais"]));
                if ($key === 2) {
                    $user[$nbUser]->setCompany($this->getReference("company-" . $i));
                }
                if ($key === 3) {
                    $user[$nbUser]->setCompany($this->getReference("company-" . rand(0, self::ROLE[2] - 1)));
                }
                $manager->persist($user[$nbUser]);
                $this->addReference("user-" . $nbUser, $user[$nbUser]);
                $nbUser++;
            }
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