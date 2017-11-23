<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 22/11/17
 * Time: 14:30
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Company;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCompanyFixtures extends Fixture implements FixtureInterface
{
    const MAX = 2;

    public function load(ObjectManager $manager) {
        $faker = Faker\Factory::create("fr_FR");
        $company = [];

        for($i = 0; $i <= self::MAX; $i++) {
            $company[$i] = new Company();
            $company[$i]->setActivity($faker->jobTitle);
            $company[$i]->setNbSalary($faker->numberBetween($min = 10, $max = 1000));
            $company[$i]->setBirthdate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()));
            $company[$i]->setSlogan($faker->sentence($nbWords = 8, $variableNbWords = true));
            $company[$i]->setQuality($faker->sentence($nbWords = 20, $variableNbWords = true));
            $company[$i]->setName($faker->company);
            $manager->persist($company[$i]);

        }

        $manager->flush();
    }
}

