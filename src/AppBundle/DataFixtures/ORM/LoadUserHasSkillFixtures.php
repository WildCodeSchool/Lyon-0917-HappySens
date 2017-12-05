<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 22/11/17
 * Time: 14:30
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\ORM\LoadSkillFixtures;
use AppBundle\DataFixtures\ORM\LoadUserFixtures;
use AppBundle\Entity\UserHasSkill;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserHasSkillFixtures extends Fixture implements FixtureInterface
{
    const MAX = 30;

    public function load(ObjectManager $manager) {
        $faker = Faker\Factory::create("fr_FR");
        $userSkills = [];

        for($j = 0; $j <= self::MAX; $j++) {
            $skills = [];
            for ($i = 0; $i <= rand(1, 10); $i++) {
                $userSkills[$i] = new UserHasSkill();
                do {
                    $skill = rand(1, 37);
                } while(in_array($skill, $skills));
                    $skills[] = $skill;
                    $userSkills[$i]->setSkill($this->getReference("skill-" . $skill));
                $userSkills[$i]->setUser($this->getReference("user-" . $j));
                $userSkills[$i]->setLevel($faker->numberBetween($min = 1, $max = 5));
                $manager->persist($userSkills[$i]);
            }
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return array(
            LoadUserFixtures::class,
            LoadSkillFixtures::class,
        );
    }
}

