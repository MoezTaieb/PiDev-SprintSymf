<?php

namespace DonBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use DonBundle\Entity\Equipment;
use GrapheBundle\Entity\Classe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Equipment controller.
 *
 */
class EquipmentController extends Controller
{
    /**
     * Lists all equipment entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $equipment = $em->getRepository('DonBundle:Equipment')->findAll();

        $pagination  = $this->get('knp_paginator')->paginate(
            $equipment,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            4/*nbre d'éléments par page*/  );
        return $this->render('equipment/index.html.twig', array("equipment"=>$pagination));
    }

    public function notifAction()
    {


    }


    /**
     * Creates a new equipment entity.
     *
     */
    public function newAction(Request $request)
    {  $equipments= $this->getDoctrine()->getManager()->getRepository(Equipment::class)->
    findbyString();
        $equipment = new Equipment();
        $form = $this->createForm('DonBundle\Form\EquipmentType', $equipment);
        $form->handleRequest($request);
        $equipment->setDateDonEquipment(new \DateTime('now'));



        $equipment->setEtatEquipment("En cours ") ;


        if ($equipment->getNbEquipment()>0){


        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($equipment);
            $em->flush();

            return $this->redirectToRoute('equipment_show', array('id' => $equipment->getId()));
        }} else

        return $this->render('equipment/new.html.twig', array(
            'equipment' => $equipment,
            'equipment'=>$equipments,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a equipment entity.
     *
     */
    public function showAction(Equipment $equipments)
    {
        $deleteForm = $this->createDeleteForm($equipments);
        $equipment= $this->getDoctrine()->getManager()->getRepository(Equipment::class)->
        findbyString();
        return $this->render('equipment/show.html.twig', array(
            'equipments' => $equipments,
            'equipment' => $equipment,

            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing equipment entity.
     *
     */
    public function editAction(Request $request, Equipment $equipment)
    {
        $deleteForm = $this->createDeleteForm($equipment);
        $editForm = $this->createForm('DonBundle\Form\EquipmentType', $equipment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('equipment_edit', array('id' => $equipment->getId()));
        }

        return $this->render('equipment/edit.html.twig', array(
            'equipment' => $equipment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a equipment entity.
     *
     */
    public function deleteAction(Request $request, Equipment $equipment)
    {   $equipments= $this->getDoctrine()->getManager()->getRepository(Equipment::class)->
    findbyString();
        $form = $this->createDeleteForm($equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($equipment);
            $em->flush();
        }

        return $this->redirectToRoute('equipment_index');
    }

    /**
     * Creates a form to delete a equipment entity.
     *
     * @param Equipment $equipment The equipment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Equipment $equipment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('equipment_delete', array('id' => $equipment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }



    public function TraiterequipmentAction()
    {
        $equipment= $this->getDoctrine()->getManager()->getRepository(Equipment::class)->
        findBy(['etatEquipment'=>'En Cours']);
        return $this->render("equipment/traiter.html.twig",array('equipment'=>$equipment));
    }
    public function AccepterequipmentAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $conge=$em->getRepository(equipment::class)->find($id);
        $conge->setetatEquipment("recu");
        $em->persist($conge);
        $em->flush();
        return $this->redirectToRoute('equipment_index');
    }
    public function RefuserequipmentAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $conge=$em->getRepository(equipment::class)->find($id);
        $conge->setetatEquipment("recu");
        $em->persist($conge);
        $em->flush();
        return $this->redirectToRoute('equipment_index');
    }
    public function impAction()
    {
        $em = $this->getDoctrine()->getManager();

        $equipment = $em->getRepository('DonBundle:Equipment')->findAll();

        return $this->render('equipment/imp.html.twig', array(
            'equipment' => $equipment,
        ));
    }





    public function stmatAction()
    {

        $equipment = $this->getDoctrine()
            ->getRepository('DonBundle:Equipment')
            ->countNumberPrintedForCategory();
     // var_dump($equipment);die;
        return  $equipment ;

    }

    public function StatAction()
    {
        $pieChart = new PieChart();
        $em= $this->getDoctrine();
        $classes = $em->getRepository(Equipment::class)->findAll();
        $total=0;
        foreach($classes as $equipment) {
            $total=$total+$equipment->getNbEquipment();
        }

        $data= array();
        $stat=['classe', 'nbEquipment'];
        $nb=0;
        array_push($data,$stat);
        foreach($classes as $equipment) {
            $stat=array();
            array_push
            ($stat,$equipment->getNomEquipment(),(($equipment->getNbEquipment()) *100)/$total);
            $nb=($equipment->getNbEquipment() *100)/$total;
            $stat=[$equipment->getNomEquipment(),$nb];
            array_push($data,$stat);

        }

        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Pourcentages des quantite par equipment');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);


        return $this->render('equipment/stat.html.twig', array('piechart' => $pieChart));
    }



}
