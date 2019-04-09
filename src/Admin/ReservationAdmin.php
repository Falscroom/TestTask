<?php
/**
 * Created by PhpStorm.
 * User: Falscroom
 * Date: 04.04.2019
 * Time: 18:08
 */

// src/Admin/CustomViewAdmin.php
namespace App\Admin;

use App\Entity\Desk;
use App\Entity\TableType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

final class ReservationAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class)
            ->add('number', TextType::class)
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
            ->add('date', DateType::class)
            ->add('time', TimeType::class)
            ->add('end_time', TimeType::class)
            ->add('desk', EntityType::class, [
                'class' => Desk::class,
                'choice_label' => 'type.type',
            ])
            ->add('approved', CheckboxType::class);
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('number')
            ->add('date')
            ->add('time')
            ->add('endTime')
            ->add('approved')
            ->add('_action', null, [
                        'actions' => [
                            'delete' => [],
                            'approve' => [
                                'template' => 'admin/buttons/approve_action.html.twig',
                            ]
                        ]
                    ]);
    }
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->add('approve', $this->getRouterIdParameter().'/approve');
    }

}