<?php

namespace AppBundle\Controller;

use AppBundle\Entity\NotificationSystem;
use AppBundle\Service\NotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Notificationsystem controller.
 *
 * @Route("notification")
 */
class NotificationSystemController extends Controller
{
    /**
     * Lists all notificationSystem entities.
     *
     * @Route("/list/{slug}", name="list")
     * @Method("GET")
     */
    public function indexAction(NotificationService $notificationService)
    {
        $em = $this->getDoctrine()->getManager();
        $idUser = $this->getUser()->getId();
        $allNotif = $em->getRepository('AppBundle:NotificationSystem')->findAllByUser($idUser);

        return $this->render('pages/In/notifications/listingNotifications.html.twig', [
            'not    ifs' => $allNotif,
        ]);
    }

    /**
     * Finds and displays a notificationSystem entity.
     *
     * @Route("/{id}", name="notificationsystem_show")
     * @Method("GET")
     */
    public function showAction(NotificationSystem $notificationSystem)
    {

        return $this->render('notificationsystem/show.html.twig', array(
            'notificationSystem' => $notificationSystem,
        ));
    }
}
