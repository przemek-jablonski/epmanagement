<?php

namespace TicketBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use TicketBundle\Entity\ticket;
use TicketBundle\Form\ticketType;
use CustomMailerBundle\Controller\DefaultController;
use TicketBundle\Repository\ticketRepository;

/**
 * ticket controller.
 *
 */
class ticketController extends Controller
{
    private $firstLogin = true;
    private $session;

    /**
     * Lists all ticket entities.
     *
     */
    public function indexAction()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var \Doctrine\ORM\EntityRepository $repository */
        $repository = $em->getRepository('TicketBundle:ticket');


        $upcomingTicketsVisible = $repository->findAllUpcomingTicketsUser($this->getUser());
        $overdueTicketsVisible = array();


        /*
        $overdueTicketsAll = $em->getRepository('TicketBundle:ticket')->findAllOverdueTickets();

        $overdueTicketsVisible = array();
        foreach($overdueTicketsAll as $ticket)
            if($ticket->getUserCreated() == $this->getUser())
                array_push($overdueTicketsVisible, $ticket);
        */

        /*
        $upcomingTicketsAll = $em->getRepository('TicketBundle:ticket')->findAllUpcomingTickets();
        $overdueTicketsAll = $em->getRepository('TicketBundle:ticket')->findAllOverdueTickets();
        $upcomingTicketsVisible = array();
        $overdueTicketsVisible = array();



        foreach($upcomingTicketsAll as $ticket)
            if($ticket->getUserCreated() == $this->getUser())
                array_push($upcomingTicketsVisible, $ticket);


        foreach($overdueTicketsAll as $ticket)
            if($ticket->getUserCreated() == $this->getUser())
                array_push($overdueTicketsVisible, $ticket);
*/

        return $this->render('TicketBundle:Ticket:index.html.twig', array(
            'upcomingTickets' => $upcomingTicketsVisible,
            'overdueTickets' => $overdueTicketsVisible,
            'controllerAction' => 'indexAction()'
        ));
    }

    public function firstIndexAction() {


        $em = $this->getDoctrine()->getManager();

        $upcomingTicketsAll = $em->getRepository('TicketBundle:ticket')->findAllUpcomingTickets();
        $overdueTicketsAll = $em->getRepository('TicketBundle:ticket')->findAllOverdueTickets();
        $upcomingTicketsVisible = array();
        $overdueTicketsVisible = array();



        foreach($upcomingTicketsAll as $ticket)
            if($ticket->getUserCreated() == $this->getUser())
                array_push($upcomingTicketsVisible, $ticket);


        foreach($overdueTicketsAll as $ticket)
            if($ticket->getUserCreated() == $this->getUser())
                array_push($overdueTicketsVisible, $ticket);



        $this->session = new Session();
        $this->session->getFlashBag()->add('flash_success', 'Good to see you back! See all of your tickets below...');

        return $this->render('TicketBundle:Ticket:index.html.twig', array(
            'upcomingTickets' => $upcomingTicketsVisible,
            'overdueTickets' => $overdueTicketsVisible,
            'controllerAction' => 'indexAction()'
        ));
    }

    /**
     * Creates a new ticket entity.
     *
     */
    public function newAction(Request $request)
    {
        $ticket = new ticket();

        $form = $this->createForm(new ticketType(), $ticket);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $ticket->setUserCreated($this->getUser());
            $ticket->setDateCreation(new \DateTime());
            $this->get('custommailerservice')->sendNewTicketMail($this->getUser(), $ticket);

            $em = $this->getDoctrine()->getManager();
            $em->persist($ticket);
            $em->flush();

            /*
            $mailer = new DefaultController();
            $this->mailer->sendNewTicketMail($ticket->getUserCreated(), $ticket);
*/


            $this->session = new Session();
            $this->session->getFlashBag()
                ->add('flash_success', 'Congratulations on successfully creating a new ticket!');

            return $this->redirectToRoute('ticketcrud_show', array('slug' => $ticket->getSlug()));
        }

        if($form->isSubmitted() && !$form->isValid()) {
            $this->session = new Session();
            $this->session->getFlashBag()
                ->add('flash_error', 'There are some errors in form data we have received. Please fix them.');
        }

        return $this->render('TicketBundle:Ticket:new.html.twig', array(
            'ticket' => $ticket,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ticket entity.
     *
     */
    public function showAction($slug)
    {
//        $deleteForm = $this->createDeleteForm($ticket);

        $manager = $this->getDoctrine()->getManager();


        $ticket = $manager->getRepository('TicketBundle:ticket')->findOneBy(array('slug' => $slug));


        $form = $this->createDeleteForm($ticket);

        if(!$ticket) {
            throw $this->createNotFoundException('Unable to find given ticket');
        }

        return $this->render('TicketBundle:Ticket:show.html.twig', array(
            'ticket' => $ticket,
            'delete_form' => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing ticket entity.
     *
     */
    public function editAction(Request $request, ticket $ticket)
    {
        $deleteForm = $this->createDeleteForm($ticket);
        $editForm = $this->createForm(new ticketType(), $ticket);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ticket);
            $em->flush();

            return $this->redirectToRoute('ticketcrud_edit', array('id' => $ticket->getId()));
        }

        return $this->render('TicketBundle:Ticket:edit.html.twig', array(
            'ticket' => $ticket,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ticket entity.
     *
     */
    public function deleteAction(Request $request, ticket $ticket)
    {
        $form = $this->createDeleteForm($ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ticket);
            $em->flush();
        }

        return $this->redirectToRoute('ticketcrud_index');
    }

    /**
     * Creates a form to delete a ticket entity.
     *
     * @param ticket $ticket The ticket entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ticket $ticket)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ticketcrud_delete', array('id' => $ticket->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
