<?php

namespace AppBundle\Form;

use AppBundle\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('town', TextType::class)
            ->add('companyID', TextType::class)
            ->add('post', TextType::class)
            ->add('phone', NumberType::class)
            ->add('email')
            ->add('password', TextType::class)
            ->add('confirmPassword', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}