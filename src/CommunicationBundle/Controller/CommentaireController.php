<?php

namespace CommunicationBundle\Controller;

use CommunicationBundle\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Commentaire controller.
 *
 * @Route("commentaire")
 */
class CommentaireController extends Controller
{



    /*
     *modfier un commentaire
     * */
    public function editCommentAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $commentaire = $em->getRepository('CommunicationBundle:Commentaire')->find($id);
        $user = $this->getUser();
        if($commentaire)
        {
            if($commentaire->getCommentateur()->getId()==$user->getId())
            {


           $from = $this->createForm('CommunicationBundle\Form\CommentaireType', $commentaire);


           $from->handleRequest($request);

        if ($from->isSubmitted() && $from->isValid()) {
                $annnonce=$commentaire->getAnnonce();
                $em->persist($commentaire);
                $em->flush();
                return $this->redirectToRoute('showDetails', array('id' => $annnonce->getId()));}

        return $this->render('@Communication/Default/annonceDetailsCommentEdit.html.twig', array(
            'commentaire' => $commentaire,
            'annonce' =>  $commentaire->getAnnonce(),
            'form' => $from->createView(),
            'user'=> $this->getUser()

            ));



            }
        return $this->render('@Communication/Default/404.html.twig');

    }



    }

    /*
     *supprimer un commentaire
     * */
    public function deleteCommentAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $commentaire = $em->getRepository('CommunicationBundle:Commentaire')->find($id);
        $user = $this->getUser();
        if($commentaire)
        {
            if($commentaire->getCommentateur()->getId()==$user->getId())
            {
            $annnonce=$commentaire->getAnnonce();
            $em->remove($commentaire);
            $em->flush();
            return $this->redirectToRoute('showDetails', array('id' => $annnonce->getId()));

        }
        }
        return $this->render('@Communication/Default/404.html.twig');

    }


}
