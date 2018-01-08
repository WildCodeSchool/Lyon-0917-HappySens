<?php

namespace AppBundle\Form;

use AppBundle\Entity\Language;
use AppBundle\Entity\Skill;
use AppBundle\Entity\UserHasSkill;
use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
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
        $builder->add('firstName')->add('lastName')->add('phone')->add('email')->add('status', HiddenType::class)->add('birthdate', BirthdayType::class, ['placeholder' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day')])->add('photo')->add('biography')->add('slogan')->add('password', HiddenType::class)->add('mood', RangeType::class, array('attr' => array('min' => 0, 'max' => 5)))->add('job')->add('workplace')->add('nativeLanguage')->add('languagesUser', EntityType::class, ['class' => Language::class, 'required' => false, 'empty_data' => null, 'multiple' => true,])->add('company')->add('isActive', HiddenType::class)->add('userskills', CollectionType::class, ['entry_type' => UserHasSkillType::class, 'allow_add' => true, 'allow_delete' => true, 'prototype' => true,]);

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'AppBundle\Entity\User'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
