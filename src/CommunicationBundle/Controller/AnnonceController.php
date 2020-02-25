<?php

namespace CommunicationBundle\Controller;

use CommunicationBundle\Entity\Annonce;
use CommunicationBundle\Entity\Commentaire;
use CommunicationBundle\Entity\Recommandation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use  Octopush\Api\Client;

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
    public function indexAction(Request $request)
    {

        // From your controller or service
        $data = array(
            'id' => 1,
            'contenu' => "My custom message",
            'userNotifier_id'=>1
        );
        $pusher = $this->get('mrad.pusher.notificaitons');
        $channel = 'messages';
        $pusher->trigger($data, $channel);





        $em = $this->getDoctrine()->getManager();

        $annonces = $em->getRepository('CommunicationBundle:Annonce')->findAll();

        $annonces  = $this->get('knp_paginator')->paginate(
            $annonces,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            6/*nbre d'éléments par page*/
        );


        return $this->render('@Communication/Default/annonceList.html.twig', array(
            'annonces' => $annonces,
        ));
    }
    public function orderByDateDESCAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $annonces = $em
            ->getRepository('CommunicationBundle:Annonce')
            ->createQueryBuilder('e')
            ->addOrderBy('e.dateAnnonce', 'DESC')
            ->getQuery()
            ->execute();
        if(!$annonces) {
            $result['entities']['error'] = "ads not found";
        } else {
            $result['entities'] = $this->getRealEntities($annonces);
        }

        return new Response(json_encode($result));


    }
    public function orderByDateTitleAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $annonces = $em
            ->getRepository('CommunicationBundle:Annonce')
            ->createQueryBuilder('e')
            ->addOrderBy('e.titreAnnonce','DESC')

        ->getQuery()
            ->execute();
        if(!$annonces) {
            $result['entities']['error'] = "ads not found";
        } else {
            $result['entities'] = $this->getRealEntities($annonces);
        }

        return new Response(json_encode($result));
    }
    public function statAction()
    {


/*
        $client = new Client('fedi.lahbib1@esprit.tn', 'rh7ONxNDwzCsJFkcRXwjEyrS5708Cbix');


        $client->setSmsRecipients(['+21652291826']);
        $client->setSmsSender('AnySender');

        $response =  $client->send('Octopush - Send SMS like a PRO.');
*/





        $transport = new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl');
        $transport->setUsername('cpadev96@gmail.com')->setPassword('esprit2019');

        $mailer = new \Swift_Mailer($transport);

        $message = new \Swift_Message('Weekly Hours');
        $message
            ->setFrom(['cpadev96@gmail.com' => 'My Name'])
            ->setTo(['cpadev96@gmail.com' => 'Recipient'])
            ->setSubject('Weekly Hours')
            ->setBody('Test Message', 'text/html');

        $this->get('mailer')->send($message);








        $em = $this->getDoctrine()->getManager();
        $annStat = $em
            ->getRepository('CommunicationBundle:Annonce')
            ->statAnn();
        $comStat= $em
            ->getRepository('CommunicationBundle:Annonce')
            ->statCom();


        return $this->render('@Communication/Default/stat.html.twig', array(
            'comStat' => $comStat,
            'annStat' => $annStat,

        ));

    }

    public function searchlistAction()
    {
        $em = $this->getDoctrine()->getManager();

        $annonces = $em->getRepository('CommunicationBundle:Annonce')->findAll();

        return $this->render('@Communication/Default/search.html.twig', array(
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
            $recommeAnn= $em->getRepository('CommunicationBundle:Recommandation')->findBy(array('annonce' =>$annonces, 'recommandeur' => $user));

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
                    'form' => $form->createView(),
                 'recommeAnn'=>$recommeAnn
                 ));
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


    public function searchAction(Request $request)
    {
        $requestString = $request->get('q');
        $em = $this->getDoctrine()->getManager();
        $entities = $em
            ->getRepository('CommunicationBundle:Annonce')
            ->createQueryBuilder('e')
            ->Where('e.titreAnnonce LIKE \'%'.$requestString.'%\'')
            ->addOrderBy('e.titreAnnonce', 'DESC')
            ->getQuery()
            ->execute();

        if(!$entities) {
            $result['entities']['error'] = "ads not found";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }

        return new Response(json_encode($result));
    }

    public function getRealEntities($entities){
        foreach ($entities as $entity){
            $realEntities[$entity->getId()] =["username"=>$entity->getPosteur()->getUsername(),"imageUrlUser"=>$entity->getPosteur()->getImageUrlUser(),"id"=>$entity->getId(),"titre"=>$entity->getTitreAnnonce(),"desc"=>$entity->getDescriptionAnnonce(),"img"=>$entity->getImageUrlAnnonce(),"DateAnnonce"=>$entity->getDateAnnonce()];

        }

        return $realEntities;

    }



    public function recommanderAction($annonceid)
    {
        $rec =new Recommandation();
        $em = $this->getDoctrine()->getManager();

        $annonce = $em->getRepository('CommunicationBundle:Annonce')->find($annonceid);
        if($annonce!=null) {

            $rec->setAnnonce($annonce);
            $rec->setRecommandeur($this->getUser());

            $em->persist($rec);
            $em->flush();

            return $this->redirect('/showDetails/'.$annonce->getId());
        }
    }

    public function deconseillerAction($annonceid)
    {

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository('CommunicationBundle:Annonce')->find($annonceid);

        if($annonce!=null) {
            $recommeAnn = $em->getRepository('CommunicationBundle:Recommandation')->findOneBy(array('annonce' => $annonce, 'recommandeur' => $user));
            $em->remove($recommeAnn);
            $em->flush();
            return $this->redirect('/showDetails/'.$annonce->getId());

        }
    }
}
