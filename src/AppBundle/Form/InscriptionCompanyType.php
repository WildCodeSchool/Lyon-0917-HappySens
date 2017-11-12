<?php

namespace AppBundle\Form;

use AppBundle\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;

class InscriptionCompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameCompany', TextType::class)
            ->add('activity', TextType::class)
            ->add('address',TextType::class)
            ->add('createDate',TextType::class)
            ->add('location',TextType::class)
            ->add('nbPeople',
                ChoiceType::class, [
                    'placeholder' => 'Votre choix',
                    'choices' => [
                        '< 50' => '1',
                        '51 - 250' => '2',
                        '> 251' => '3',
                    ],
                ])
            ->add('contactHappySens', TextType::class)
            ->add('phoneHappySens', NumberType::class)
            ->add('emailHappySens')
            ->add('password', PasswordType::class)
            ->add('confirmationPassword', PasswordType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}