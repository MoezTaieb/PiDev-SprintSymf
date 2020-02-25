<?php

namespace CommunicationBundle\Controller;

use AppBundle\Entity\User;
use CommunicationBundle\Entity\Annonce;
use CommunicationBundle\Entity\Notifications;
use Swift_Mailer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    public function mailForUserAction   (Request $request)
{

    //mail moez
    $transport = new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl');
    $transport->setUsername('moez.taieb@esprit.tn')->setPassword('193JMT4407');
    $mailer = new \Swift_Mailer($transport);
    ///

    $defaultData = ['message' => ''];
    $form = $this->createFormBuilder($defaultData)
        ->add('name', TextType::class)
        ->add('email', EntityType::class, [
            'class' => User::class,
            'choice_label' => 'email',
        ])->add('choices', ChoiceType::class, [
    'choices'  => [
        'all' => true,
        'for selected email address' => false,
    ],
])->add('message', TextareaType::class)
        ->add('send', SubmitType::class)
        ->getForm();
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $data = $form->getData();
        $em = $this->getDoctrine()->getManager();
        $userManager = $this->container->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        if($data["choices"]==true)
        {

            foreach ( $users  as $value)
            {
                //$data["message"]
                //$data["name"]
                //$data["email"]
             //   return new Response($value->getEmail());
                $message = new \Swift_Message('Weekly Hours');
                $message
                    ->setFrom(['othmenhosni@esprit.tn' => 'My Name'])
                    ->setTo([$data["email"]=> 'Recipient'])
                    ->setSubject($data["name"])
                    ->setBody($data["message"], 'text/html');
                $this->get('mailer')->send($message);
            }

        }else{

            foreach ( $users  as $value)
            {
                if($value->getUsername()==$data["email"])
                {
                 //$data["message"]
                    //$data["name"]
                    //$data["email"]
                   // return new Response($value->getEmail());

                    $message = new \Swift_Message('Weekly Hours');
                    $message
                        ->setFrom(['othmenhosni@esprit.tn' => 'My Name'])
                        ->setTo([$data["email"]=> 'Recipient'])
                        ->setSubject($data["name"])
                        ->setBody($data["message"], 'text/html');
                    $this->get('mailer')->send($message);
                    
                    break;
                }
            }
        }


        $form = $this->createFormBuilder($defaultData)
            ->add('name', TextType::class)
            ->add('email', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
            ])->add('choices', ChoiceType::class, [
                'choices'  => [
                    'all' => true,
                    'for selected email address' => false,
                ],
            ])->add('message', TextareaType::class)
            ->add('send', SubmitType::class)
            ->getForm();
        return $this->render('@Communication/Default/email.html.twig',array("form"=>$form->createView()));

    }
        return $this->render('@Communication/Default/email.html.twig',array("form"=>$form->createView()));
    }


    public  function marquerAction(Request $request)
    {
        $requestString = $request->get('q');
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('CommunicationBundle:Notifications')->find($requestString);
        $entities->setVue(1);

        $em->persist($entities);
        $em->flush();

        return new Response('marque');
    }


    public function sendNotificationAction(Request $request)
    {

        $defaultData = ['message' => ''];
        $form = $this->createFormBuilder($defaultData)
            ->add('contenu', TextType::class)
            ->add('username', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])->add('choices', ChoiceType::class, [
                'choices'  => [
                    'all' => true,
                    'for selected user' => false,
                ],
            ])
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            if($data["choices"]==true)
            {
                $userManager = $this->container->get('fos_user.user_manager');
                $users = $userManager->findUsers();
                foreach ( $users  as $value)
                {
                       $not=new Notifications();
                       $not->setContenu(   $data["contenu"]);
                       $not->setVue(0);
                       $not->setUserNotifier($value);
                        $em->persist($not);
                        $em->flush();
                }
            }else{
                        $userManager = $this->container->get('fos_user.user_manager');
                         $users = $userManager->findUsers();
                        foreach ( $users  as $value)
                            {
                                   if($value->getUsername()==$data["username"])
                                    {
                                          $not=new Notifications();
                                          $not->setContenu(   $data["contenu"]);
                                          $not->setVue(0);
                                          $not->setUserNotifier($value);
                                          $em->persist($not);
                                          $em->flush();
                                          break;
                                    }
                            }
            }

            $form = $this->createFormBuilder($defaultData)
                ->add('contenu', TextType::class)
                ->add('username', EntityType::class, [
                    'class' => User::class,
                    'choice_label' => 'username',
                ])->add('choices', ChoiceType::class, [
                    'choices'  => [
                        'all' => true,
                        'for selected user' => false,
                    ],
                ])
                ->add('send', SubmitType::class)

                ->getForm();

            return $this->render('@Communication/Default/notification.html.twig',array("form"=>$form->createView()));
         }
        return $this->render('@Communication/Default/notification.html.twig',array("form"=>$form->createView()));
    }


}
