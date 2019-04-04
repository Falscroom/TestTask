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
            ->add('sun', DayType::class )
            ->add('mon', DayType::class )
            ->add('tue', DayType::class )
            ->add('wed', DayType::class )
            ->add('thu', DayType::class )
            ->add('fri', DayType::class )
            ->add('sat', DayType::class )
            ->add('save', SubmitType::class)->getForm();
    }
}