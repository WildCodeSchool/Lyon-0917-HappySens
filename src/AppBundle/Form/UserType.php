<?php

namespace AppBundle\Form;

use AppBundle\Entity\Language;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('phone')
            ->add('email')
            ->add('status')
            ->add('birthdate')
            ->add('photo')
            ->add('biography')
            ->add('slogan')
            ->add('password')
            ->add('mood')
            ->add('job')
            ->add('workplace')
            ->add('nativeLanguage')
            ->add('languagesUser', EntityType::class, [
            'class' => Language::class,
            'required' => false,
            'empty_data' => null,
            'multiple' => true,
        ])
            ->add('company')
            ->add('isActive');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
