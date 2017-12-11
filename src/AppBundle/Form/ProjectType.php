<?php

namespace AppBundle\Form;

use AppBundle\Entity\Skill;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
                ->add('startingDate', TextType::class, ['mapped' => false])
                ->add('endDate', TextType::class)
                ->add('author', TextType::class, ['mapped' => false])
                ->add('status', TextType::class, ['mapped' => false])
                ->add('photo', TextType::class, ['mapped' => false])
                ->add('location', TextType::class)
                ->add('presentation')
                ->add('profit')
                ->add('beneficeCompany')
                ->add('likeProjects', TextType::class, ['mapped' => false])
                ->add('teamProject', TextType::class, ['mapped' => false])
                ->add('theme', EntityType::class, [
                    'class' => Skill::class,
                    'placeholder' => 'Choisir votre theme',
                        'required'   => false,
                        'empty_data' => null

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
