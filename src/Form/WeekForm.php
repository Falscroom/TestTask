<?php
/**
 * Created by PhpStorm.
 * User: Falscroom
 * Date: 05.04.2019
 * Time: 2:55
 */


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class WeekForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = null)
    {
        $options = null;
        return $builder
            ->add('Sunday', DayType::class ,array(
                'required' => false
            ))
            ->add('Monday', DayType::class )
            ->add('Tuesday', DayType::class )
            ->add('Wednesday', DayType::class )
            ->add('Thursday', DayType::class )
            ->add('Friday', DayType::class )
            ->add('Saturday', DayType::class )
            ->add('save', SubmitType::class)
            ->getForm();
    }
}