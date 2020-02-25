<?php

namespace CampBundle\Controller;

use CampBundle\Entity\Camp;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Camp controller.
 *
 */
class CampController extends Controller
{
    /**
     * Lists all camp entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $camps = $em->getRepository('CampBundle:Camp')->findAll();
        $camp  = $this->get('knp_paginator')->paginate(
            $camps,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            6/*nbre d'éléments par page*/);
        return $this->render('camp/index.html.twig', array(
            'camps' => $camp,
        ));
    }

    /**
     * Creates a new camp entity.
     *
     */
    public function newAction(Request $request)
    {

        $camp = new Camp();
        $form = $this->createForm('CampBundle\Form\CampType', $camp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($camp);
            $a=$camp->getResponsable();

            $em->flush();

            return $this->redirectToRoute('camp_show', array('id' => $camp->getId()));
        }

        return $this->render('camp/new.html.twig', array(
            'camp' => $camp,
            'form' => $form->createView(),
        ));



    }

    /**
     * Finds and displays a camp entity.
     *
     */
    public function showAction(Camp $camp)
    {
        $deleteForm = $this->createDeleteForm($camp);

        return $this->render('camp/show.html.twig', array(
            'camp' => $camp,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing camp entity.
     *
     */
    public function editAction(Request $request, Camp $camp)
    {
        $deleteForm = $this->createDeleteForm($camp);
        $editForm = $this->createForm('CampBundle\Form\CampType', $camp);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('camp_edit', array('id' => $camp->getId()));
        }

        return $this->render('camp/edit.html.twig', array(
            'camp' => $camp,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a camp entity.
     *
     */
    public function deleteAction(Request $request, Camp $camp)
    {
        $form = $this->createDeleteForm($camp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($camp);
            $em->flush();
        }

        return $this->redirectToRoute('camp_index');
    }
    public function pdf2Action()
    {
        $em = $this->getDoctrine()->getManager();

        $camps = $em->getRepository('CampBundle:Camp')->findAll();

        return $this->render('camp/pdf.html.twig', array(
            'camps' => $camps,
        ));
    }

    public function search2Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('p');
        $posts =  $em->getRepository('CampBundle:Camp')->findEntitiesByString($requestString);
        if(!$posts) {
            $result['posts']['error'] = "Post Not found :( ";
        } else {
            $result['posts'] = $this->getRealEntities($posts);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($posts){
        foreach ($posts as $posts){
            $realEntities[$posts->getId()] = [$posts->getNomCamp()];

        }
        return $realEntities;
    }


    public function statAction()
    {
        $pieChart= new PieChart();
        $em= $this->getDoctrine();
        $camps = $em->getRepository('CampBundle:Camp')->findAll();
        $totalRefugier=0;
        foreach($camps as $camp) {
            $totalRefugier=$totalRefugier+$camp->getNbrefugier();
        }

        $data= array();
        $stat=['camp', 'nbrefugier'];
        $nb=0;
        array_push($data,$stat);
        foreach($camps as $camp) {
            $stat=array();
            array_push($stat,$camp->getNomCamp(),(($camp->getNbrefugier()) *100)/$totalRefugier);
            $nb=($camp->getNbrefugier() *100)/$totalRefugier;
            $stat=[$camp->getNomCamp(),$nb];
            array_push($data,$stat);

        }

        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Pourcentages des camp par refugier');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);


        return $this->render('camp/stat.html.twig', array('piechart' =>$pieChart));
    }





/**
     * Creates a form to delete a camp entity.
     *
     * @param Camp $camp The camp entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Camp $camp)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('camp_delete', array('id' => $camp->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


}
