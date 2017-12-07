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
        $listLanguage = ['de'=> 'Allemand (standard)',
'en-us'=> 'Anglais (USA)',
'en-gb'=> 'Anglais (Grande Bretagne)',
'fr-be'=> 'Français (Belgique)',
'it'=> 'Italien (standard)',
'es'=> 'Espagnol (traditionnel)',
'fr-ca'=> 'Français (Canada)',
'fr-lu'=> 'Français (Luxembourg)',
'fr-mc'=> 'Français (Monaco)',
'fr-ch'=> 'Français (Suisse)',
'ja'=> 'Japonnais (standard)',
'es-mx'=> 'Espagnol (Mexique)',
'ru'=> 'Russe',
'en'=> 'Anglais (standard)',
'nl-be'=> 'Flamand (Belgique)',
'cs'=> 'Tchécoslovaque (standard)',
'de-ch'=> 'Allemand (Suisse)',
'es-ar'=> 'Espagnol (Argentine)',
'en-ca'=> 'Anglais (Canada)',
'nl'=> 'Flamand (standard)',
'el'=> 'Grecque (standard)',
'no'=> 'Norvégien (standard)',
'sv'=> 'Suédois (standard)',
'en-ie'=> 'Anglais (Ireland)',
'fr-fr'=> 'Français (France)',
'pt'=> 'Portuguais (standard)',
'pt-br'=> 'Portuguais (Brésil)',
'ko'=> 'Coréen (standard)',
'zh-cn'=> 'Chinois (Provinces)',
'pl'=> 'Polonais (standard)',
'fr'=> 'Français (standard)',
'th'=> 'Thaï',
'sq'=> 'Albanais',
'uk'=> 'Ukrainien',
'inconnu'=> 'Origine indéterminée',
'de-lu'=> 'Allemand (Luxembourg)',
'fr-netch'=> 'Français (Netchallenge)',
'he'=> 'Hébreu',
'en,q=1.0'=> 'Anglais (standard)',
'ar-sa'=> 'Arabe (Arabie Saoudite)',
'tr'=> 'Turc',
'ar-dz'=> 'Arabe (Algérie)',
'en-jm'=> 'Anglais (Jamaïque)',
'fr,q=1.0'=> 'Français (standard)',
'de-at'=> 'Allemand (Autriche)',
'ar-eg'=> 'Arabe (Egypte)',
'hu'=> 'Hongrois',
'yi'=> 'Yiddish',
'ro'=> 'Roumain',
'fa'=> 'Farsi',
'da'=> 'Danois',
'ar-ma'=> 'Arabe (Maroc)',
'fi'=> 'Finnois',
'es-co'=> 'Espagnol (Colombie)',
'en-au'=> 'Anglais (Australie)',
'zh-tw'=> 'Chinois (Taïwan)',
'es-ec'=> 'Espagnol (Equateur)',
'lt'=> 'Italien (standard)',
'da-dk'=> 'Danois (Danemark)',
'id'=> 'Indonésien',
'de-de'=> 'Allemand (Allemagne)',
'et'=> 'Estonien',
'es-cl'=> 'Espagnol (Chili)',
'es-gt'=> 'Espagnol (Guatemala)',
'es-ve'=> 'Espagnol (Venezuela)',
'en-nz'=> 'Anglais (Nouvelle Zélande)',
'nl-nl'=> 'Flamand (Pays-Bas)',
'zu'=> 'Zoulou',
'es-pe'=> 'Espagnol (Pérou)',
'sl'=> 'Slovène',
'hu-hu'=> 'Hongrois (Hongrie)',
'it-it'=> 'Italien (Italie)',
'es-ni'=> 'Espagnol (Nicaragua)',
'en-ki'=> 'Anglais (Kiribati)',
'en-tt'=> 'Anglais (Trinidad et Tobago)',
'ja-jp'=> 'Japonnais (Japon)'];

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