<?php

namespace DonBundle\Controller;

use DonBundle\Entity\Equipment;
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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $equipment = $em->getRepository('DonBundle:Equipment')->findAll();

        return $this->render('equipment/index.html.twig', array(
            'equipment' => $equipment,
        ));
    }

    /**
     * Creates a new equipment entity.
     *
     */
    public function newAction(Request $request)
    {
        $equipment = new Equipment();
        $form = $this->createForm('DonBundle\Form\EquipmentType', $equipment);
        $form->handleRequest($request);
        $equipment->setDateDonEquipment(new \DateTime('now'));
        $equipment->setEtatEquipment("En cours ") ;
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipment);
            $em->flush();

            return $this->redirectToRoute('equipment_show', array('id' => $equipment->getId()));
        }

        return $this->render('equipment/new.html.twig', array(
            'equipment' => $equipment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a equipment entity.
     *
     */
    public function showAction(Equipment $equipment)
    {
        $deleteForm = $this->createDeleteForm($equipment);

        return $this->render('equipment/show.html.twig', array(
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
    {
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


    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $posts =  $em->getRepository('DonBundle:Equipment')->findEntitiebyString($requestString);
        if(!$posts) {
            $result['equipment']['error'] = "Post Not found :( ";
        } else {
            $result['equipment'] = $this->getRealEntities($posts);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($equipment){
        foreach ($equipment as $equipment){
            $realEntities[$equipment->getId()] = [$equipment->getNomEquipment()];

        }
        return $realEntities;
    }

}
