<?php
/**
 * Created by PhpStorm.
 * User: Falscroom
 * Date: 04.04.2019
 * Time: 18:08
 */

// src/Controller/CustomViewCRUDController.php

namespace App\Controller;

use App\Entity\ExceptionDay;
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
            $em = $this->getDoctrine()->getManager();
            $data = $day->getData();
            $interval = new \DateInterval('P1D');
            $period = new \DatePeriod($data['range_start'],$interval,$data['range_end']);
            foreach ($period as $date) {
                $exceptionDay = new ExceptionDay($date,$data['start'],$data['end'],$data['IsDayOff']);
                $em->persist($exceptionDay);
            }
            $exceptionDay = new ExceptionDay($data['range_end'],$data['start'],$data['end'],$data['IsDayOff']);
            $em->persist($exceptionDay);
            $em->flush();

        }

        return $this->renderWithExtraParams('admin/calendar.html.twig',[
            'form' => $day->createView()
        ]);
    }
}