<?php

namespace CommunicationBundle\Controller;

use CommunicationBundle\Entity\Annonce;
use CommunicationBundle\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * Annonce controller.
 *
 */
class AnnonceController extends Controller
{


    /**
     * Lister tout les annonces .
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $annonces = $em->getRepository('CommunicationBundle:Annonce')->findAll();

        return $this->render('@Communication/Default/annonceList.html.twig', array(
            'annonces' => $annonces,
        ));
    }


    /**
      *  afficher une  annonce.
     */
    public function showDetailsAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $annonces = $em->getRepository('CommunicationBundle:Annonce')->find($id);
        $user = $this->getUser();

        if($annonces!=null)
        {
                // commenter sur une annonce
                $commentaire = new Commentaire();
                $form = $this->createForm('CommunicationBundle\Form\CommentaireType', $commentaire);
                $form->handleRequest($request);

                    if ($form->isSubmitted() && $form->isValid())
                    {

                        $em = $this->getDoctrine()->getManager();

                        $commentaire->setAnnonce($annonces);

                        $commentaire->setDateCommentaire(new \DateTime());

                        $commentaire->setCommentateur($this->getUser());

                        $em->persist($commentaire);

                        $em->flush();

                        return $this->redirectToRoute('showDetails', array('id' => $id));
                     }

                 return $this->render('@Communication/Default/annonceDetails.html.twig', array(
                    'annonce' => $annonces,
                    'user' =>  $user,
                    'form' => $form->createView()));
        }else{
                return $this->render('@Communication/Default/404.html.twig');
        }
    }


    /**
     *  supprimer une annonce.
     */
    public function deleteAdAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository('CommunicationBundle:Annonce')->find($id);
        $user = $this->getUser();

            if($annonce!==null )
            {

                if($annonce->getPosteur()->getId()==$user->getId())
                {
                    $em->remove($annonce);

                    $em->flush();

                    return  $this->redirect('/consulerannonce');

                }else

                    return $this->render('@Communication/Default/404.html.twig');


            }

        return $this->render('@Communication/Default/404.html.twig');
    }

    /**
     * déposer une annonce.
     *
     */
    public function newAction(Request $request)
    {
        $annonce = new Annonce();
        $form = $this->createForm('CommunicationBundle\Form\AnnonceType', $annonce);
        $form->handleRequest($request);
        $this->date = new \DateTime('now');
        $em = $this->getDoctrine()->getManager();
        $annonce->setDateAnnonce(new \DateTime());
        $annonce->setPosteur($this->getUser());

                if ($form->isSubmitted() && $form->isValid())
                {


                    //upload image

                    $brochureFile = $form->get('brochure')->getData();
                        if ($brochureFile) {

                            $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);

                            $originalFilename= $originalFilename.'.'.$brochureFile->guessExtension();

                            try {
                                    $brochureFile->move(
                                        $this->getParameter('brochures_directory'),
                                      $originalFilename);
                                 } catch (FileException $e) {
                            }


                           $annonce->setImageUrlAnnonce($originalFilename);

                 }else{
                            $annonce->setImageUrlAnnonce(null);
                        }

            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute('showDetails', array('id' => $annonce->getId()));

        }
        return $this->render('@Communication/Default/posterAonnonce.html.twig', array(
            'annonce' => $annonce,
            'form' => $form->createView(),
        ));

    }

    /**
     * modifier une annonce.
     *
     */
    public function editAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository('CommunicationBundle:Annonce')->find($id);

        $user = $this->getUser();
        if($annonce!==null )
        {
            if($annonce->getPosteur()->getId()==$user->getId())
            {

                $form = $this->createForm('CommunicationBundle\Form\AnnonceType', $annonce);
                $form->handleRequest($request);


                if ($form->isSubmitted() && $form->isValid()) {


                    //image code
                    $brochureFile = $form->get('brochure')->getData();

                    if ($brochureFile) {
                        $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);

                        $originalFilename= $originalFilename.'.'.$brochureFile->guessExtension();
                        try {
                            $brochureFile->move(
                                $this->getParameter('brochures_directory'),
                                $originalFilename
                            );
                        } catch (FileException $e) {
                        }

                        $annonce->setImageUrlAnnonce($originalFilename);


                    }else{

                        $annonce->setImageUrlAnnonce(null);
                    }
                    $em->persist($annonce);
                    $em->flush();

                    return $this->redirectToRoute('showDetails', array('id' => $annonce->getId()));

                }

                return $this->render('@Communication/Default/modifierAnnonce.html.twig', array(
                    'annonce' => $annonce,
                    'form' => $form->createView()));

            }else
                return $this->render('@Communication/Default/404.html.twig');


        }
        return $this->render('@Communication/Default/404.html.twig');

    }

}
