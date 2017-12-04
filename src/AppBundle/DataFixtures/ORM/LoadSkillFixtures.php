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
    const MAX = 37;

    public function load(ObjectManager $manager) {
        $faker = Faker\Factory::create("fr_FR");
        $skills = [];
        $listSkill = ['bien-être','bricolage', 'broderie', 'cause animale', 'cause humanitaire', 'chant',
'cinéma', 'cirque', 'collection d\'objet', 'couture','cuisine', 'culture et jardinage', 'danse', 'décoration',
 'dessin', 'ecologie','ecriture', 'gastronomie', 'gravure', 'jeux vidéos','littérature','maquettisme', 'musique',
  'Oenologie', 'peinture', 'photographie','sculpture','spectacle', 'sport animalier', 'sport aérien', 'sport collectif',
  'sport de combat', 'sport handisport', 'sport individuel', 'sport mécanique', 'sport de montagne','sport nautique',
   'théâtre','tricot' ];

        for($i = 0; $i <= self::MAX; $i++) {
            $skills[$i] = new Skill();
            $skills[$i]->setNameSkill($listSkill[$i]);
            $manager->persist($skills[$i]);

            $this->addReference("skill-" . $i, $skills[$i]);
        }


        $manager->flush();
    }
}