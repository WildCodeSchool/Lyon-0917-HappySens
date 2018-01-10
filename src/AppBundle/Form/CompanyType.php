<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('activity')
            ->add('name')
            ->add('nbSalary')
            ->add('birthdate', BirthdayType::class, [
        'placeholder' => array(
            'year' => 'Year', 'month' => 'Month', 'day' => 'Day'
        )
    ])
            ->add('slogan')
            ->add('quality')
            ->add('threeCriteria')
            ->add('location')
            ->add('quality')
            ->add('fileUsers', FileType::class)
            ->add('logo', FileType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Company',
            'users' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_company';
    }


}
