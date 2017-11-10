<?php

namespace AppBundle\Form;

use AppBundle\Entity\NewProject;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameProject', TextType::class)
            ->add('location', TextType::class)
            ->add('dateStart', TextType::class)
            ->add('dateEnd', TextType::class)
            ->add('theme', ChoiceType::class, [
                'expanded' => false,
                'multiple' => false,
                'placeholder' => 'Thème du projet',
                'choices' => [
                    'Bien-Être' => 'bien-être',
                    'Bricolage' => 'bricolage',
                    'Broderie' => 'broderie',
                    'Cause animale' => 'cause animale',
                    'Cause humanitaire' => 'cause humanitaire',
                    'Chant' => 'chant',
                    'Cinéma' => 'cinéma',
                    'Cirque' => 'cirque',
                    'Collection d\'objet' => 'collection d\'objet',
                    'Couture' => 'couture',
                    'Cuisine' => 'cuisine',
                    'Culture et jardinage' => 'culture et jardinage',
                    'Danse' => 'danse',
                    'Décoration' => 'décoration',
                    'Dessin' => 'dessin',
                    'Ecologie' => 'ecologie',
                    'Ecriture' => 'ecriture',
                    'Gastronomie' => 'gastronomie',
                    'Gravue' => 'gravure',
                    'Jeux vidéos' => 'jeux vidéos',
                    'Littérature' => 'littérature',
                    'Maquettisme' => 'maquettisme',
                    'Musique' => 'musique',
                    'Oenologie' => 'Oenologie',
                    'Peinture' => 'peinture',
                    'Photographie' => 'photographie',
                    'Sculpture' => 'sculpture',
                    'Spectacle' => 'spectacle',
                    'Sport animalier' => 'sport animalier',
                    'Sport aérien' => 'sport aérien',
                    'Sport collectif' => 'sport collectif',
                    'Sport de combat' => 'sport de combat',
                    'Sport handisport' => 'sport handisport',
                    'Sport individuel' => 'sport individuel',
                    'Sport mécanique' => 'sport mécanique',
                    'Sport de montagne' => 'sport de montagne',
                    'Sport nautique' => 'sport nautique',
                    'Théâtre' => 'théâtre',
                    'Tricot' => 'tricot',
                ],
            ])
            ->add('languages', ChoiceType::class, [
                'expanded' => false,
                'multiple' => false,
                'placeholder' => 'Langues parlées (1 obligatoire, 4 optionnelles)',
//                'required' => false,
                'choices' => [
                    'Français' => 'français',
                    'Anglais' => 'anglais',
                    'Allemand' => 'allemand',
                    'Chinois' => 'chinois',
                    'Coréen' => 'coréen',
                    'Espagnol' => 'espagnol',
                    'Grec' => 'grec',
                    'Italien' => 'italien',
                    'Japonais' => 'japonais',
                    'Polonais' => 'polonais',
                    'Portuguais' => 'portuguais',
                    'Russe' => 'russe',
                ],
            ])
            ->add('description', TextType::class)
            ->add('advantagesCompany', TextType::class)
            ->add('advantagesGroup', TextType::class)
            ->add('uploadPicture', FileType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewProject::class,
        ]);
    }
}