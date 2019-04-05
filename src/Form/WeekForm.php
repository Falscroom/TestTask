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
        return $builder
            ->add('Sunday', DayType::class, array(
                'data' => $options[0]
            ))
            ->add('Monday', DayType::class, array(
                'data' => $options[1]
            ))
            ->add('Tuesday', DayType::class, array(
                'data' => $options[2]
            ))
            ->add('Wednesday', DayType::class, array(
                'data' => $options[3]
            ))
            ->add('Thursday', DayType::class, array(
                'data' => $options[4]
            ))
            ->add('Friday', DayType::class, array(
                'data' => $options[5]
            ))
            ->add('Saturday', DayType::class, array(
                'data' => $options[6]
            ))
            ->add('save', SubmitType::class)
            ->getForm();
    }
}