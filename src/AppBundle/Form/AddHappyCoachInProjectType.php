<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 12/01/18
 * Time: 15:50
 */

namespace AppBundle\Form;


use AppBundle\Entity\Project;
use AppBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class AddHappyCoachInProjectType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('happyCoach', EntityType::class, [
                'class' => User::class,
                'required' => false,
                'empty_data' => null,
                'multiple' => false,
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