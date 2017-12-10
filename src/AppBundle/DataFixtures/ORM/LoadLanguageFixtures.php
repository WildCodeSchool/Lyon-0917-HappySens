<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 06/12/17
 * Time: 16:12
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadLanguageFixtures extends Fixture implements FixtureInterface
{

    public function load(ObjectManager $manager) {
        $languages = [];
        $listLanguage = [
            'fr' => ' Français',
            'sq' => ' Albanais',
            'de' => ' Allemand',
            'en' => ' Anglais',
            'ar' => ' Arabe',
            'zh' => ' Chinois',
            'ko' => ' Coréen',
            'da' => ' Danois',
            'es' => ' Espagnol ',
            'et' => ' Estonien',
            'fa' => ' Farsi',
            'fi' => ' Finnois',
            'nl' => ' Flamand ',
            'el' => ' Grecque',
            'hu' => ' Hongrois',
            'he' => ' Hébreu',
            'id' => ' Indonésien',
            'it' => ' Italien',
            'ja' => ' Japonnais',
            'no' => ' Norvégien',
            'pl' => ' Polonais',
            'pt' => ' Portuguais',
            'ro' => ' Roumain',
            'ru' => ' Russe',
            'sl' => ' Slovène',
            'sv' => ' Suédois',
            'cs' => ' Tchécoslovaque',
            'th' => ' Thaï',
            'tr' => ' Turc',
            'uk' => ' Ukrainien',
            'yi' => ' Yiddish',
            'zu' => ' Zoulou'
        ];

        $i = 1;
        foreach($listLanguage as $key => $language) {
            $languages[$i] = new Language();
            $languages[$i]->setCode($key);
            $languages[$i]->settitreLanguage($language);
            $manager->persist($languages[$i]);
            $this->addReference("language-" . $i, $languages[$i]);
            $i++;
        }

        $manager->flush();
    }
}