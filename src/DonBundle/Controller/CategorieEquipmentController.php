<?php

namespace DonBundle\Controller;

use DonBundle\Entity\CategorieEquipment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Categorieequipment controller.
 *
 */
class CategorieEquipmentController extends Controller
{
    /**
     * Lists all categorieEquipment entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorieEquipments = $em->getRepository('DonBundle:CategorieEquipment')->findAll();

        return $this->render('categorieequipment/index.html.twig', array(
            'categorieEquipments' => $categorieEquipments,
        ));
    }

    /**
     * Creates a new categorieEquipment entity.
     *
     */
    public function newAction(Request $request)
    {
        $categorieEquipment = new Categorieequipment();
        $form = $this->createForm('DonBundle\Form\CategorieEquipmentType', $categorieEquipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieEquipment);
            $em->flush();

            return $this->redirectToRoute('categorieequipment_show', array('id' => $categorieEquipment->getId()));
        }

        return $this->render('categorieequipment/new.html.twig', array(
            'categorieEquipment' => $categorieEquipment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categorieEquipment entity.
     *
     */
    public function showAction(CategorieEquipment $categorieEquipment)
    {
        $deleteForm = $this->createDeleteForm($categorieEquipment);

        return $this->render('categorieequipment/show.html.twig', array(
            'categorieEquipment' => $categorieEquipment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categorieEquipment entity.
     *
     */
    public function editAction(Request $request, CategorieEquipment $categorieEquipment)
    {
        $deleteForm = $this->createDeleteForm($categorieEquipment);
        $editForm = $this->createForm('DonBundle\Form\CategorieEquipmentType', $categorieEquipment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorieequipment_edit', array('id' => $categorieEquipment->getId()));
        }

        return $this->render('categorieequipment/edit.html.twig', array(
            'categorieEquipment' => $categorieEquipment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categorieEquipment entity.
     *
     */
    public function deleteAction(Request $request, CategorieEquipment $categorieEquipment)
    {
        $form = $this->createDeleteForm($categorieEquipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorieEquipment);
            $em->flush();
        }

        return $this->redirectToRoute('categorieequipment_index');
    }

    /**
     * Creates a form to delete a categorieEquipment entity.
     *
     * @param CategorieEquipment $categorieEquipment The categorieEquipment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CategorieEquipment $categorieEquipment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categorieequipment_delete', array('id' => $categorieEquipment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
