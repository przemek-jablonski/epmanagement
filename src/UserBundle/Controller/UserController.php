<?php
/**
 * Created by PhpStorm.
 * User: Ciemek
 * Date: 16/01/16
 * Time: 3:54 AM
 */

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TicketBundle\Repository\ticketRepository;
use UserBundle\Entity\user;
use UserBundle\Repository\userRepository;
use AestheticBundle\Containers\BootstrapNavbar;
use AestheticBundle\Containers\NavbarHelperElements;


class UserController extends Controller {

    public function profileAction() {
        /** @var ticketRepository $repo */
        $repository = $this->getDoctrine()->getRepository('TicketBundle:ticket');

        /** @var userRepository $userRepository */
        $userRepository = $this->getDoctrine()->getRepository('UserBundle:user');

        /** @var user $userProfiled */
//        $userProfiled = $repo->


        if($this->get('security.context')->isGranted('ROLE_ADMIN')) {
            $upcomingTickets = $repository->getTicketsUpcomingAdmin();
            $overdueTickets = $repository->getTicketsOverdueAdmin();
            $doneTickets = $repository->getTicketsDoneAdmin();
        } else {
            $upcomingTickets = $repository->getTicketsUpcoming($this->getUser());
            $overdueTickets = $repository->getTicketsOverdue($this->getUser());
            $doneTickets = $repository->getTicketsDone($this->getUser());
        }

        $allTicketsCount = count($upcomingTickets) + count($overdueTickets) + count($doneTickets);

        $activeText = "Tickets to be done: " . ((count($upcomingTickets) / $allTicketsCount) * 100) . "% (" . count($upcomingTickets) . "/" . $allTicketsCount . ")";

        return $this->render('UserBundle:Profile:userprofile.html.twig', array(
            'helper' => (new NavbarHelperElements())->createHelperUserProfile(),
            'navbarLeft' => (new BootstrapNavbar())->createNavbarIndexLeft(),
            'navbarRight' => (new BootstrapNavbar())->createNavbarStandardRight(),
            'user' => $this->getUser(),
            'overallPercent' => 100,
            'overallText' => "All of your tickets: ". $allTicketsCount,
            'activeArray' => $upcomingTickets,
            'activePercent' => (count($upcomingTickets) / $allTicketsCount) * 100,
            'activeText' => $activeText,
            'doneArray' => $doneTickets,
            'donePercent' => (count($doneTickets) / $allTicketsCount) * 100,
            'doneText' => "Tickets completed: " . (count($doneTickets) / $allTicketsCount) * 100 . "% (" . count($doneTickets) . "/" . $allTicketsCount . ")",
            'overdueArray' => $overdueTickets,
            'overduePercent' => (count($overdueTickets) / $allTicketsCount) * 100,
            'overdueText' => "Tickets completed: " . (count($overdueTickets) / $allTicketsCount) * 100 . "% (" . count($overdueTickets) . "/" . $allTicketsCount . ")",
        ));
    }

}