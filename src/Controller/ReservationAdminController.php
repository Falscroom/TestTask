<?php
/**
 * Created by PhpStorm.
 * User: Falscroom
 * Date: 04.04.2019
 * Time: 18:08
 */

// src/Controller/CustomViewCRUDController.php

namespace App\Controller;

use App\Entity\Reservation;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ReservationAdminController extends CRUDController
{
    public function approveAction($id)
    {
        /*Логика кнопки approve в списке броней*/
        $reservation = $this->getDoctrine()->getRepository(Reservation::class)->findOneById($id);
        $reservation->setApproved(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($reservation);
        $em->flush();
        return new RedirectResponse($this->admin->generateUrl('list'));
    }
}