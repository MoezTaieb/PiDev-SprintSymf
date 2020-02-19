<?php

namespace EventBundle\Controller;

use EventBundle\Entity\Evenement;
use EventBundle\Entity\Invite;
use EventBundle\Entity\Participation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use EventBundle\Form\EvenementType;
use EventBundle\Form\InviteType;
use Symfony\Component\Validator\Constraints\DateTime;
class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('EventBundle:Evenement')->findAll();
        return $this->render('@Event/Default/index.html.twig', array('ev' => $event));
    }

    public function afficherAction()
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('EventBundle:Evenement')->findAll();
        return $this->render('@Event/Default/event.html.twig', array('ev' => $event));

    }

    public function ajouterEventAction(Request $request)
    {
        $event = new Evenement();
        $form = $this->createForm(EvenementType::class, $event);
        $form->handleRequest($request);
        if ($form->isValid()) {
            /**
             * @var UploadedFile $file
             */
            $file=$event->getImage();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('image_directory'),$fileName
            );
            $event->setImage($fileName);
            $em = $this->getDoctrine();
            $em->getManager()->persist($event);
            $em->getManager()->flush();
            return $this->redirectToRoute("CRUDevent");

        }
        return $this->render('@Event\Default\Ajout.html.twig', array(
            'form' => $form->createView()
        ));


    }

    public function supprimerEventAction(Request $req, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $sup = $em->getRepository('EventBundle:Evenement')->find($id);
        $em->remove($sup);
        $em->flush();

        return $this->redirectToRoute("CRUDevent");
    }


    public function updateEventAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("EventBundle:Evenement")->find($id);
        $form = $this->createForm(EvenementType::class, $event);
        $form->handleRequest($request);
        if ($form->isValid()) {
            /**
         * @var UploadedFile $file
         */
            $file=$event->getImage();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('image_directory'),$fileName
            );
            $event->setImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute("CRUDevent");

        }
        return $this->render('@Event\Default\Update.html.twig', array('form' => $form->createView()));

    }

    public function AjouterInvitAction(Request $request,$id)
    {
        $invit = new Invite();
        $form = $this->createForm(InviteType::class, $invit);
        $em = $this->getDoctrine()->getManager();
        $inv= $em->getRepository("EventBundle:Evenement")->find($id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $invit->setEvenement($inv);
            $em = $this->getDoctrine();
            $em->getManager()->persist($invit);
            $em->getManager()->flush();
            return $this->redirectToRoute("CRUDevent");

        }
        return $this->render('@Event\Default\AjoutInvit.html.twig', array(
            'f1' => $form->createView()

        ));

    }
    public function AfficheInvitAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $invit = $em->getRepository('EventBundle:Invite')->getInvitById($id);
        return $this->render('@Event/Default/Invit.html.twig', array('inv' => $invit));

    }

    public function updateInvitAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $invit = $em->getRepository("EventBundle:Invite")->find($id);
        $form = $this->createForm(InviteType::class, $invit);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invit);
            $em->flush();
            return $this->redirectToRoute("CRUDevent");

        }
        return $this->render('@Event\Default\UpdateInvit.html.twig', array('f2' => $form->createView()));

    }

    public function supprimerInvitAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $sup = $em->getRepository('EventBundle:Invite')->find($id);
        $em->remove($sup);
        $em->flush();

        return $this->redirectToRoute("CRUDevent");
    }




    public function affecterParticipantAction($id)
    {
        $part= new Participation();
        $user=$this->getUser();
        $date= new \DateTime();
        $user=$this->container->get('security.token_storage')->getToken()->getUser();
        $user->getId();
        $em = $this->getDoctrine()->getManager();
        $eve = $em->getRepository('EventBundle:Evenement')->find($id);
        $part->setDateParticipation($date);
        $part->setEvenement($eve);
        $part->setParticipant($user);
        $em = $this->getDoctrine();
        $em->getManager()->persist($part);
        $em->getManager()->flush();
        return $this->redirectToRoute("event");

    }




}