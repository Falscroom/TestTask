<?php
/**
 * Created by PhpStorm.
 * User: Falscroom
 * Date: 04.04.2019
 * Time: 18:08
 */

// src/Admin/CustomViewAdmin.php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sonata\AdminBundle\Route\RouteCollection;

final class ExceptionDayAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('date', DateType::class)
            ->add('start', TimeType::class)
            ->add('end', TimeType::class)
            ->add('isDayOff', CheckboxType::class, array(
                'required' => false
            ));
    }

    /*    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
        {
            $datagridMapper->add('name');
        }*/

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('date')
            ->addIdentifier('start',null, array(
                'label' => 'Start time' ))
            ->addIdentifier('end', null, array(
                'label' => 'Time of the end' ))
            ->addIdentifier('isDayOff', null, array(
                'label' => 'Is it day off?' ))
/*            ->addIdentifier('end')->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                    'clone' => [
                        'template' => 'admin/list__action_clone.html.twig',
                    ]
                ]
            ])*/;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('create_calendar');
    }

    public function getDashboardActions()
    {
        $actions = parent::getDashboardActions();

        $actions['create_calendar'] = [
            'label' => 'Add with calendar',
            'translation_domain' => 'SonataAdminBundle',
            'url' => $this->generateUrl('create_calendar'),
            'icon' => 'level-up',
        ];

        return $actions;
    }


}