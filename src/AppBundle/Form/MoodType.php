<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 14/01/18
 * Time: 18:19
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;

class MoodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('mood', RangeType::class, [
                'attr' => [
                    'min' => 0,
                    'max' => 5
                ],]);

    }

}