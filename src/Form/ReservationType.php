<?php
/**
 * Created by PhpStorm.
 * User: Falscroom
 * Date: 05.04.2019
 * Time: 2:48
 */

namespace App\Form;

use App\Entity\Desk;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = null)
    {
        return $builder
            ->add('name', TextType::class)
            ->add('number', TextType::class)
            ->add('desk', EntityType::class, array(
                'class' => Desk::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'type.type',
            ))
            ->add('duration', ChoiceType::class, array(
                'choices'  => array(
                    '30min' => '30M',
                    '1h' => '1H',
                    '1h 30min' => '1H30M',
                    '2h' => '2H',
                    '2h 30min' => '2H30M',
                    '3h' => '3H',
                    '3h 30min' => '3H30M',
                    '4h' => '4H',

                ),
            ))
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'yyyy/MM/dd',
            ))
            ->add('time', TimeType::class , array(
                'widget' => 'single_text',
                'html5' => false,
            ))
            ->add('reserve', SubmitType::class )
            ->getForm();
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Reservation',
        ));
    }
}