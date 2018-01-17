<?php

namespace AppBundle\Form;

use AppBundle\Entity\Skill;
use AppBundle\Entity\Language;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class)
            ->add('startingDate', DateType::class, ['mapped' => false])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
            ])
            ->add('author', TextType::class, ['mapped' => false])
            ->add('status', TextType::class, ['mapped' => false])
            ->add('location', TextType::class)
            ->add('presentation')
            ->add('profit')
            ->add('photo', FileType::class, [
                'label' => 'photo projet',
                'required' => false,
                ])
            ->add('beneficeCompany')
            ->add('likeProjects', TextType::class, ['mapped' => false])
            ->add('teamProject', TextType::class, ['mapped' => false])
            ->add('theme', EntityType::class, [
                'class' => Skill::class,
                'placeholder' => 'Choisir votre theme',
                'required' => false,
                'empty_data' => null,
            ])
            ->add('languagesProject', EntityType::class, [
                'class' => Language::class,
                'required' => false,
                'empty_data' => null,
                'multiple' => true,
              ]);
 }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Project'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_project';
    }


}
