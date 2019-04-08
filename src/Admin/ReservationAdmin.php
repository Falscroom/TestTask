<?php
/**
 * Created by PhpStorm.
 * User: Falscroom
 * Date: 04.04.2019
 * Time: 18:08
 */

// src/Admin/CustomViewAdmin.php
namespace App\Admin;

use App\Entity\TableType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Route\RouteCollection;

final class ReservationAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {

    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
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