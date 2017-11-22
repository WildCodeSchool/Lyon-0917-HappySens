<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 22/11/17
 * Time: 14:30
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Company;
use AppBundle\Entity\Project;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCompanyFixtures extends Fixture implements FixtureInterface
{
    const MAX = 10;

    public function load(ObjectManager $manager) {
        $faker = Faker\Factory::create("fr_FR");
        $project = [];

        for($i = 0; $i <= self::MAX; $i++) {
            $project[$i] = new Project();
            $project[$i]->setActivity($faker->jobTitle);
            $project[$i]->setNbSalary($faker->numberBetween($min = 10, $max = 1000));
            $project[$i]->setBirthdate($faker->date($format="AAAA-MM-JJ",$max="1999"));
            $project[$i]->setSlogan($faker->sentence($nbWords = 8, $variableNbWords = true));
            $project[$i]->setQuality($faker->sentences($nb = 3, $asText = false));
            $project[$i]->setName($faker->company);
            $manager->persist($project[$i]);
        }
        $manager->flush();
    }
}

