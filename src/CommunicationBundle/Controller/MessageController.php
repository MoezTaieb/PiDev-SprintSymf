<?php

namespace CommunicationBundle\Controller;

use AppBundle\Entity\User;
use CommunicationBundle\Entity\Message;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Message controller.
 *
 * @Route("message")
 */
class MessageController extends Controller
{
    public function newSmsAction   (Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll();
        $messages = $em->getRepository('CommunicationBundle:Message')->findAll();


        $defaultData = ['message' => 'Avenger 3A20','numero'=>'+216'];
        $form = $this->createFormBuilder($defaultData)
            ->add('numero', TextType::class)
            ->add('message', TextareaType::class)
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            //$client = new Client('fedi.lahbib1@esprit.tn', 'rh7ONxNDwzCsJFkcRXwjEyrS5708Cbix');

            //$client->setSmsRecipients([$data["numero"]]);
            //$client->setSmsSender('3A20pidev');
            //$response =  $client->send($data["message"]);



            $message = new Message();
            $message->setContenuMessage('tel:'.$data["numero"]." contenu:".$data["message"]);
            $message->setDateEnvoiMessage(new \DateTime());
            $message->setEmetteur( $this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
        /*
            code de demonstation
             $client = new Client('fedi.lahbib1@esprit.tn', 'rh7ONxNDwzCsJFkcRXwjEyrS5708Cbix');
        $client->setSmsRecipients(['+21652291826']);
        $client->setSmsSender('3A20pidev');
        $response =  $client->send('Octopush - Send SMS like a PRO.');
         * */
            $form = $this->createFormBuilder($defaultData)
                ->add('numero', TextType::class)
                ->add('message', TextareaType::class)
                ->add('send', SubmitType::class)
                ->getForm();

            return $this->render('@Communication/Default/sms.html.twig',array("form"=>$form->createView(),"users"=>$users,"messages"=>$messages));

        }

        return $this->render('@Communication/Default/sms.html.twig',array("form"=>$form->createView(),"users"=>$users,"messages"=>$messages));
    }

}
