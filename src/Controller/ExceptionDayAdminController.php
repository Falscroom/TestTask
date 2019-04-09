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
use App\Form\ExceptionDayType;

class ExceptionDayAdminController extends CRUDController
{
    public function createCalendarAction(Request $request)
    {
        $show_success_message = false;
        $day = new ExceptionDayType();
        $day = $day->buildForm($this->createFormBuilder());
        $repository = $this->getDoctrine()->getRepository(ExceptionDay::class);

        $day->handleRequest($this->getRequest());


        if ($day->isSubmitted() && $day->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $data = $day->getData();
            $interval = new \DateInterval('P1D');
            $period = new \DatePeriod($data['range_start'],$interval,$data['range_end']);

            /*Стараемся найти существующие обьекты, чобы не добавлять кучу значений в БД */
            $existing_days = $repository->getBetween($data['range_start'],$data['range_end']);
            $existing_days = $repository->datesAsKeys($existing_days);

            foreach ($period as $date) {
                if(isset($existing_days[$date->format('Y-m-d')])) {
                    $exceptionDay = $existing_days[$date->format('Y-m-d')]->setAll($date,$data['start'],$data['end'],$data['IsDayOff']);
                } else {
                    $exceptionDay = new ExceptionDay();
                    $exceptionDay->setAll($date,$data['start'],$data['end'],$data['IsDayOff']);
                }
                $em->persist($exceptionDay);
            }
            if(isset($existing_days[$data['range_end']->format('Y-m-d')])) {
                $exceptionDay = $existing_days[$data['range_end']->format('Y-m-d')]->setAll($data['range_end'],$data['start'],$data['end'],$data['IsDayOff']);
            } else {
                $exceptionDay = new ExceptionDay();
                $exceptionDay->setAll($data['range_end'],$data['start'],$data['end'],$data['IsDayOff']);
            }
            $em->persist($exceptionDay);
            $em->flush();
            $show_success_message = true;

        }

        return $this->renderWithExtraParams('admin/calendar.html.twig',[
            'form' => $day->createView(), 'show_success_message' => $show_success_message
        ]);
    }
}