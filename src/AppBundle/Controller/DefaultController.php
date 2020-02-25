<?php

namespace AppBundle\Controller;

use DonBundle\Entity\Equipment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/front", name="homepagefront")
     */
    public function indexAction()
    {$em = $this->getDoctrine()->getManager();

        $equipment= $this->getDoctrine()->getManager()->getRepository(Equipment::class)->
        findbyString();
        $service= $this->getDoctrine()->getManager()->getRepository(Service::class)-> findbySnom() ;
        return $this->render("Default/index.html.twig",array('equipment'=>$equipment ,
            'service' =>$service));


    }
    /**
     * @Route("/back", name="homepageback")
     */
    public function indexbackAction()
    {
        $em = $this->getDoctrine()->getManager();

        $equipment= $this->getDoctrine()->getManager()->getRepository(Equipment::class)->
        findBy(['etatEquipment'=>'En Cours']);

        return $this->render("baseback.html.twig",array('equipment'=>$equipment));


    }
}
