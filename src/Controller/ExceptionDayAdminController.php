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
use App\Form\ExceptionDayForm;

class ExceptionDayAdminController extends CRUDController
{
    public function createCalendarAction(Request $request)
    {
        $day = new ExceptionDayForm();
        $day = $day->buildForm($this->createFormBuilder());

        $day->handleRequest($this->getRequest());


        if ($day->isSubmitted() && $day->isValid()) {
/*            var_dump($day);
            $data = $day->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();*/
            $data = $day->getData();
        }

        return $this->renderWithExtraParams('admin/calendar.html.twig',[
            'form' => $day->createView()
        ]);
    }
}