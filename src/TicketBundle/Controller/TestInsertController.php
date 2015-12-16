<?php

namespace TicketBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TicketBundle\Entity\ticket;
use Symfony\Component\DependencyInjection\Container;



class TestInsertController extends Controller {

    public function insertAction(){
        //route: ticket/test/insertTicket

        $entityManager = $this->getDoctrine()->getEntityManager();
        $currentDate = new \DateTime("now");
        $newTicket = new ticket();

        $newTicket->setName("TicketTest");
        $newTicket->setDescription("super ticket");
        $newTicket->setDateCreation($currentDate);
        $newTicket->setDateDeadline(date_add($currentDate, date_interval_create_from_date_string("28 days")));
        $newTicket->setNumberPoints(3);
        $newTicket->setProject("project 1 - test");
        $newTicket->setUserCreated("userreporter1");
        $newTicket->setUserAssigned("userassgnee1");
        $newTicket->setStatus("ongoing");

        $entityManager->persist($newTicket);
        $entityManager->flush();

        return $this->render('TicketBundle:TestInsert:insertandshow.html.twig',
                                array('databaseAddition' => $newTicket));
    }
}


?>