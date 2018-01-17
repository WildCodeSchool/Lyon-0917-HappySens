<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class editCompanyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('activity')
            ->add('name')
            ->add('nbSalary',ChoiceType::class, [
                'choices' => [
                    '0-50' => 1,
                    '51-250' => 2,
                    '251-500' => 3,
                    '> 501' => 4,
                ],

            ])
            ->add('birthdate', TextType::class, [
                'label' => 'Date de Création',
            ])
            ->add('slogan')
            ->add('quality')
            ->add('threeCriteria')
            ->add('location')
            ->add('quality')
            ->add('fileUsers', FileType::class, array('mapped' => false))
            ->add('logo', FileType::class, array('mapped' => false, 'required' => false))
            ->add('facebook', UrlType::class, [
                'required' => false,
                'label' => 'https://www.facebook.com/',
                ])
            ->add('twitter', UrlType::class, [
                'required' => false,
                'label' => 'https://twitter.com/',
            ])
            ->add('linkedin', UrlType::class, [
                'required' => false,
                'label' => 'https://www.linkedin.com/in/',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Company',
            'users' => 'AppBundle\Entity\User',
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
