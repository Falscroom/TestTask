<?php
/**
 * Created by PhpStorm.
 * User: Falscroom
 * Date: 08.04.2019
 * Time: 23:15
 */

namespace App\Controller;

use App\Entity\ExceptionDay;
use App\Entity\Reservation;
use App\Entity\Schedule;
use App\Form\ReservationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ReservationController  extends AbstractController
{
    /**
     * @Route("/")
     */
    public function main(Request $request, ValidatorInterface $validator)
    {
        $custom_errors = []; $errors = [];

        $reservation = new Reservation();
        $day = $this->createForm(ReservationType::class, $reservation);
        $day->handleRequest($request);


        if ($day->isSubmitted() && $day->isValid()) {

            $reservation = $day->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $reservation->setApproved(false);
            $endTime = new \DateTime($reservation->getTime()->format('Y-m-d H:i'));
            $reservation->setEndTime(
                $endTime->add(new \DateInterval('PT' . $reservation->getDuration()))
            );
            $entityManager->persist($reservation);

            $already_reserved = $this->getDoctrine()->getRepository(Reservation::class)->ifReserved(
                $reservation->getTime()->format('H:i:s'),$endTime->format('H:i:s'),$reservation->getDate()->format('Y-m-d'),$reservation->getDesk());




            $working_day = $this->getDoctrine()->getRepository(Schedule::class)->getDayByNumDay(
                date('w',$reservation->getDate()->getTimestamp())
            );
            $exception_day = $this->getDoctrine()->getRepository(ExceptionDay::class)->findOneByDate( $reservation->getDate()->format('Y-m-d') );

            $working_day = $exception_day ? $exception_day : $working_day;

            if($reservation->getTime() >= $working_day->getStart() &&  $reservation->getEndTime() <= $working_day->getEnd() && (!$working_day->getIsDayOff())) {
                if (count($already_reserved) === 0) {
                    /*$entityManager->flush();*/
                    return $this->render('reservation_success_form.html.twig');
                } else {
                    $custom_errors[] = ['message' => 'Sorry, but this time is already reserved'];
                }
            } else {
                $custom_errors[] = ['message' => 'Sorry we are not working at this time'];
            }

        }

        if($day->isSubmitted())
            $errors = $validator->validate($reservation);
        return $this->render('reservation_form.html.twig' ,['form' => $day->createView(),'errors' => $errors, 'custom_errors' => $custom_errors]);
    }
}