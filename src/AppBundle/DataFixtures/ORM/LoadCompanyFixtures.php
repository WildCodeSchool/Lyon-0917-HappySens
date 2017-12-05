<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 22/11/17
 * Time: 14:30
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Company;
use AppBundle\Service\SlugService;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCompanyFixtures extends Fixture implements FixtureInterface
{
    const MAX = 5;

    public function load(ObjectManager $manager) {
        $faker = Faker\Factory::create("fr_FR");
        $slugService = new SlugService();
        $company = [];

        for($i = 0; $i < self::MAX; $i++) {
            $company[$i] = new Company();
            $name = $faker->company;
            $company[$i]->setActivity($faker->jobTitle);
            $company[$i]->setNbSalary($faker->numberBetween($min = 10, $max = 1000));
            $company[$i]->setBirthdate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()));
            $company[$i]->setSlogan($faker->sentence($nbWords = 8, $variableNbWords = true));
            $company[$i]->setQuality($faker->sentence($nbWords = 20, $variableNbWords = true));
            $company[$i]->setThreeCriteria($faker->sentence($nbWords = 20, $variableNbWords = true));
            $company[$i]->setName($name);
            $company[$i]->setLogo($faker->imageUrl(150, 150, 'cats'));
            $company[$i]->setLocation($faker->city);
            $company[$i]->setLanguage("Français");
            $company[$i]->setSlug($slugService->slugify($name));
            $company[$i]
                ->setFacebook($faker->url)
                ->setTwitter($faker->url)
                ->setLinkedin($faker->url);
            $this->addReference("company-" . $i, $company[$i]);
            $manager->persist($company[$i]);
        }

        $manager->flush();
    }
}

