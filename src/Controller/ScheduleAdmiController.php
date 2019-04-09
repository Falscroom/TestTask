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
use App\Form\WeekType;

class ScheduleAdmiController extends CRUDController
{
    public function listAction()
    {
        $week_arr = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        $show_success_message = false;
        $days_repository = $this->getDoctrine()->getRepository(Schedule::class);
        /* Получаем старое расписание */
        $days = $days_repository->getDays();
        if(count($days) !== 7)
            $days_repository->destroyEverything();
        /*Если с базой данных что то не правильно, то все стирается и расписание на 7 дней создается заново */
        $days = count($days) == 7 ? $days : NULL;
        $week = new WeekType();
        $week = $week->buildForm($this->createFormBuilder(),$days);
        $week->handleRequest($this->getRequest());
        if ($week->isSubmitted() && $week->isValid()) {
            $data = $week->getData();
            $em = $this->getDoctrine()->getManager();
            foreach ($data as $day) {
                $day->setNumDay(array_search($day->getDay() ,$week_arr));
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