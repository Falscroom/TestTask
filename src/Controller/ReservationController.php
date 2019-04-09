<?php
/**
 * Created by PhpStorm.
 * User: Falscroom
 * Date: 08.04.2019
 * Time: 23:15
 */

// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\ExceptionDay;
use App\Entity\Reservation;
use App\Entity\Schedule;
use App\Form\ReservationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController  extends AbstractController
{
    /**
     * @Route("/")
     */
    public function main(Request $request)
    {
        $errors = [];

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

            $working_day = $this->getDoctrine()->getRepository(Schedule::class)->getDayByNumDay($reservation->getDate()->format('N'));
            $exception_day = $this->getDoctrine()->getRepository(ExceptionDay::class)->findOneByDate( $reservation->getDate()->format('Y-m-d') );

            $working_day = $exception_day ? $exception_day : $working_day;

            if($reservation->getTime() >= $working_day->getStart() &&  $reservation->getEndTime() <= $working_day->getEnd() && (!$working_day->getIsDayOff())) {
                if (count($already_reserved) === 0) {
                    $entityManager->flush();
                } else {
                    $errors[] = 'Sorry, but this time already reserved';
                }
            } else {
                $errors[] = 'Sorry we are not working at this time';
            }

        }
        return $this->render(
            'reservation_form.html.twig' ,
            [
                'form' => $day->createView(),
                'errors' => $errors
            ]
        );
    }
}