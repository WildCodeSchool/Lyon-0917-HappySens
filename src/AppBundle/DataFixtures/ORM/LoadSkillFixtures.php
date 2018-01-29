<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 22/11/17
 * Time: 14:30
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Skill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadSkillFixtures extends Fixture implements FixtureInterface
{
    const MAX = 41;

    public function load(ObjectManager $manager) {
        $skills = [];
        $listSkill = ['Autres', 'Bien-être','Bricolage', 'Broderie', 'Cause animale', 'Cause humanitaire', 'Chant',
'Cinéma', 'Cirque', 'Collection d\'objet', 'Couture', 'Cuisine', 'Culture', 'Culture et jardinage', 'Danse', 'Décoration',
 'Dessin', 'Ecologie','Ecriture', 'Gastronomie', 'Gravure', 'Informatique', 'Jeux vidéos', 'Littérature','Maquettisme', 'Musique',
  'Oenologie', 'Peinture', 'Photographie', 'Sculpture', 'Spectacle', 'Sport animalier', 'Sport aérien', 'Sport collectif',
  'Sport de combat', 'Sport handisport', 'Sport individuel', 'Sport mécanique', 'Sport de montagne', 'Sport nautique',
   'Théâtre','Tricot', 'Voyage'];

        for($i = 0; $i <= self::MAX; $i++) {
            $skills[$i] = new Skill();
            $skills[$i]->setNameSkill($listSkill[$i]);
            $manager->persist($skills[$i]);

            $this->addReference("skill-" . $i, $skills[$i]);
        }


        $manager->flush();
    }
}