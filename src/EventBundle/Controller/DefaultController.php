<?php

namespace EventBundle\Controller;

use EventBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EventBundle\Form\EvenementType;
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Event/Default/index.html.twig');
    }
    public function afficherAction()
    {
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository('EventBundle:Evenement')->findAll();
        return $this->render('@Event/Default/event.html.twig',array('ev'=>$event));

    }

    public function ajouterEventAction(Request $request)
    {
        $event=new Evenement();
        $form=$this->createForm(EvenementType::class,$event);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em=$this->getDoctrine();
            $em->getManager()->persist($event);
            $em->getManager()->flush();
            return $this->redirectToRoute("CRUDevent");

        }
        return $this->render('@Event\Default\Ajout.html.twig', array(
            'form'=>$form->createView()
        ));


    }
    public  function supprimerEventAction(Request $req , $id)
    {
        $em=$this->getDoctrine()->getManager();
        $sup=$em->getRepository('EventBundle:Evenement')->find($id);
        $em->remove($sup);
        $em->flush();

        return  $this->redirectToRoute("CRUDevent");
    }


    public function updateEventAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository("EventBundle:Evenement")->find($id);
        $form = $this->createForm(EvenementType::class,$event);
        $form->handleRequest($request);
        if ($form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            return  $this->redirectToRoute("CRUDevent");

        }
        return $this->render('@Event\Default\Update.html.twig',array('form'=>$form->createView()));

    }

}
