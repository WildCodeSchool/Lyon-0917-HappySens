<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 22/11/17
 * Time: 14:30
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\UserHasSkill;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserHasSkillFixtures extends Fixture implements FixtureInterface
{
    const MAX = 2;

    public function load(ObjectManager $manager) {
        $faker = Faker\Factory::create("fr_FR");
        $userSkills = [];

        for($i = 0; $i <= self::MAX; $i++) {
            $userSkills[$i] = new UserHasSkill();
            $userSkills[$i]->setLevel($faker->numberBetween($min = 1, $max = 5));

            $manager->persist($userSkills[$i]);
        }
        $manager->flush();
    }
}

