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
use App\Form\WeekForm;

class ScheduleAdmiController extends CRUDController
{
    public function listAction()
    {
        $week = new WeekForm();
        $week = $week->buildForm($this->createFormBuilder());

        $week->handleRequest($this->getRequest());
        if ($week->isSubmitted() && $week->isValid()) {
            $data = $week->getData();
            $em = $this->getDoctrine()->getManager();
            foreach ($data as $day) {
                $em->persist($day);
            }
            $em->flush();
        }


        return $this->renderWithExtraParams('admin/schedule_admin.html.twig', [
            'form' => $week->createView(),
            'week' => ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
        ]);


    }
}