<?php
/**
 * Created by PhpStorm.
 * User: Falscroom
 * Date: 05.04.2019
 * Time: 2:48
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = null)
    {
        return $builder->add('day', TextType::class)
            ->add('start', TimeType::class ,array(
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
            ))
            ->add('end', TimeType::class ,array(
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
            ))
            ->add('IsDayOff', CheckboxType::class , array(
                'required' => false,
            ))
            ->getForm();
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Schedule',
        ));
    }
}