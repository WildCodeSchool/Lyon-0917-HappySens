<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 22/11/17
 * Time: 14:30
 */

namespace AppBundle\DataFixtures\ORM;

use Faker;
use AppBundle\Entity\Skill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSkillFixtures extends Fixture implements FixtureInterface
{
    const MAX = 80;

    public function load(ObjectManager $manager) {
        $faker = Faker\Factory::create("fr_FR");
        $skills = [];

        for($i = 0; $i <= self::MAX; $i++) {
            $skills[$i] = new Skill();
            $skills[$i]->setNameSkill($faker->word);
            $manager->persist($skills[$i]);

            $this->addReference("skill-" . $i, $skills[$i]);
        }


        $manager->flush();
    }
}