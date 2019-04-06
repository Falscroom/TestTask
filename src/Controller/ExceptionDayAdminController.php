<?php
/**
 * Created by PhpStorm.
 * User: Falscroom
 * Date: 04.04.2019
 * Time: 18:08
 */

// src/Controller/CustomViewCRUDController.php

namespace App\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Sonata\AdminBundle\Admin\Pool;

class ExceptionDayAdminController extends CRUDController
{
    public function createCalendarAction(Request $request, Pool $adminPool)
    {
        $styles = $adminPool->getOption('stylesheets');
        array_push ($styles , 'test.css' ) ;

        return $this->renderWithExtraParams('admin/calendar.html.twig');
    }
}