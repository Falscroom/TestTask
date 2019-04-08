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


/*        $test = $this->getDoctrine()->getRepository(ExceptionDay::class)->findOneByDate( (new \DateTime())->format('Y-m-d') );
        var_dump($test);*/

/*        $dt = new \DateTime();
        var_dump($dt);
        $dt->add(new \DateInterval('PT25M'));
        var_dump($dt);*/

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
            $entityManager->flush();

        }
        return $this->render(
            'reservation_form.html.twig' ,
            [
                'form' => $day->createView()
            ]
        );
    }
}