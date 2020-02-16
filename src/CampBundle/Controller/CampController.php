<?php

namespace CampBundle\Controller;

use CampBundle\Entity\Camp;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $camps = $em->getRepository('CampBundle:Camp')->findAll();

        return $this->render('camp/index.html.twig', array(
            'camps' => $camps,
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
