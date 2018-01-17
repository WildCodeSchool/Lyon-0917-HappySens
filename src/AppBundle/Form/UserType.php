<?php

namespace AppBundle\Form;

use AppBundle\Entity\Language;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
            ->add('phone', TextType::class, [
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'required' => true,
            ])
            ->add('status', HiddenType::class)
            ->add('birthdate', BirthdayType::class,
                [
                    'label' => 'Date de naissance',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'required' => true,
            ]
    )
            ->add('photo',FileType::class, [
                'label' => 'Votre photo',
                'required' => false,
            ])
            ->add('biography', TextType::class, [
                'required' => true,
            ])
            ->add('slogan', TextType::class, [
                'required' => true,
            ])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent correspondre',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => false,
                'first_options' => array('label' => 'Nouveau mot de passe'),
                'second_options' => array('label' => 'Confirmez votre mot de passe'),
            ))
           ->add('mood', RangeType::class, array(
                'attr' => array(
                    'min' => 0,
                    'max' => 5,
                    'required' => true,
                )))
            ->add('job', TextType::class, [
                'required' => true,
            ])
            ->add('workplace', TextType::class, [
                'required' => true,
            ])
            ->add('nativeLanguage',EntityType::class, [
                'class' => Language::class,
                'required' => false,
                'empty_data' => null,
                'multiple' => false,
            ])
            ->add('languagesUser', EntityType::class, [
            'class' => Language::class,
            'required' => false,
            'empty_data' => null,
            'multiple' => true,
        ])
            ->add('company')
            ->add('isActive', HiddenType::class)
        ->add('userskills', CollectionType::class, [
            'entry_type' => UserHasSkillType::class,
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
            'required' => true,
        ])
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
