<?php
/**
 * Created by PhpStorm.
 * User: Falscroom
 * Date: 04.04.2019
 * Time: 18:08
 */

// src/Controller/CustomViewCRUDController.php

namespace App\Controller;

use App\Entity\Schedule;
use Sonata\AdminBundle\Controller\CRUDController;
use App\Form\WeekForm;

class ScheduleAdmiController extends CRUDController
{
    public function listAction()
    {
        $show_success_message = false;
        $days = $this->getDoctrine()->getRepository(Schedule::class)->getDays();
        $days = $days ? $days : NULL; // If database empty
        $week = new WeekForm();
        $week = $week->buildForm($this->createFormBuilder(),$days);
        $week->handleRequest($this->getRequest());
        if ($week->isSubmitted() && $week->isValid()) {
            $data = $week->getData();
            $em = $this->getDoctrine()->getManager();
            foreach ($data as $day) {
                $em->persist($day);
            }
            $em->flush();
            $show_success_message = true;
        }
        return $this->renderWithExtraParams('admin/schedule_admin.html.twig', [
            'form' => $week->createView(), 'show_success_message' => $show_success_message
        ]);


    }
}