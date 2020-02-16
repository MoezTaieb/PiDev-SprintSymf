<?php

namespace DonBundle\Controller;

use DonBundle\Entity\CategorieService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Categorieservice controller.
 *
 */
class CategorieServiceController extends Controller
{
    /**
     * Lists all categorieService entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorieServices = $em->getRepository('DonBundle:CategorieService')->findAll();

        return $this->render('categorieservice/index.html.twig', array(
            'categorieServices' => $categorieServices,
        ));
    }

    /**
     * Creates a new categorieService entity.
     *
     */
    public function newAction(Request $request)
    {
        $categorieService = new Categorieservice();
        $form = $this->createForm('DonBundle\Form\CategorieServiceType', $categorieService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieService);
            $em->flush();

            return $this->redirectToRoute('categorieservice_show', array('id' => $categorieService->getId()));
        }

        return $this->render('categorieservice/new.html.twig', array(
            'categorieService' => $categorieService,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categorieService entity.
     *
     */
    public function showAction(CategorieService $categorieService)
    {
        $deleteForm = $this->createDeleteForm($categorieService);

        return $this->render('categorieservice/show.html.twig', array(
            'categorieService' => $categorieService,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categorieService entity.
     *
     */
    public function editAction(Request $request, CategorieService $categorieService)
    {
        $deleteForm = $this->createDeleteForm($categorieService);
        $editForm = $this->createForm('DonBundle\Form\CategorieServiceType', $categorieService);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorieservice_edit', array('id' => $categorieService->getId()));
        }

        return $this->render('categorieservice/edit.html.twig', array(
            'categorieService' => $categorieService,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categorieService entity.
     *
     */
    public function deleteAction(Request $request, CategorieService $categorieService)
    {
        $form = $this->createDeleteForm($categorieService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorieService);
            $em->flush();
        }

        return $this->redirectToRoute('categorieservice_index');
    }

    /**
     * Creates a form to delete a categorieService entity.
     *
     * @param CategorieService $categorieService The categorieService entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CategorieService $categorieService)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categorieservice_delete', array('id' => $categorieService->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
