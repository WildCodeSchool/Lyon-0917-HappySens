<?php

namespace AppBundle\Form;

use AppBundle\Entity\EmailContact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmailContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('email',EmailType::class)
            ->add('phone', TextType::class)
            ->add('nameCompany', TextType::class, [
                'required' => false
            ])
            ->add('status', ChoiceType::class, [
                'placeholder' => 'Votre choix',
                'choices' => [
                    'Salarié' => 'collaborators',
                    'Entreprise' => 'company',
                    'Happy Coach' => 'happyCoach',
                ],
                'required'   => false,
                'empty_data' => null
            ])
            ->add('message', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EmailContact::class,
        ]);
    }

}