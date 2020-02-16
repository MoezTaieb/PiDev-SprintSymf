<?php

namespace CampBundle\Controller;

use CampBundle\Entity\Refugie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CampBundle\Form\RefugieType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Refugie controller.
 *
 */
class RefugieController extends Controller
{
    /**
     * Lists all refugie entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refugies = $em->getRepository('CampBundle:Refugie')->findAll();

        return $this->render('refugie/index.html.twig', array(
            'refugies' => $refugies,
        ));
    }

    /**
     * Creates a new refugie entity.
     *
     */
    public function newAction(Request $request)
    {
        $refugie = new Refugie();
        $form = $this->createForm('CampBundle\Form\RefugieType', $refugie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refugie);
            $em->flush();

            return $this->redirectToRoute('refugie_show', array('id' => $refugie->getId()));
        }

        return $this->render('refugie/new.html.twig', array(
            'refugie' => $refugie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refugie entity.
     *
     */
    public function showAction(Refugie $refugie)
    {
        $deleteForm = $this->createDeleteForm($refugie);

        return $this->render('refugie/show.html.twig', array(
            'refugie' => $refugie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refugie entity.
     *
     */
    public function editAction(Request $request, Refugie $refugie)
    {
        $deleteForm = $this->createDeleteForm($refugie);
        $editForm = $this->createForm('CampBundle\Form\RefugieType', $refugie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('refugie_edit', array('id' => $refugie->getId()));
        }

        return $this->render('refugie/edit.html.twig', array(
            'refugie' => $refugie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refugie entity.
     *
     */
    public function deleteAction(Request $request, Refugie $refugie)
    {
        $form = $this->createDeleteForm($refugie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($refugie);
            $em->flush();
        }

        return $this->redirectToRoute('refugie_index');
    }

    /**
     * Creates a form to delete a refugie entity.
     *
     * @param Refugie $refugie The refugie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Refugie $refugie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('refugie_delete', array('id' => $refugie->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('p');
        $posts =  $em->getRepository('CampBundle:Refugie')->findEntitiesByString($requestString);
        if(!$posts) {
            $result['posts']['error'] = "Post Not found :( ";
        } else {
            $result['posts'] = $this->getRealEntities($posts);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($posts){
        foreach ($posts as $posts){
            $realEntities[$posts->getId()] = [$posts->getNomRefugie()];

        }
        return $realEntities;
    }

    public function pdfAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refugies = $em->getRepository('CampBundle:Refugie')->findAll();

        return $this->render('refugie/pdf.html.twig', array(
            'refugies' => $refugies,
        ));
    }
}
