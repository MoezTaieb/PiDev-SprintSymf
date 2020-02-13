<?php

namespace CommunicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Communication/Default/index.html.twig');
    }

    public function consulerannonceAction()
    {
        return $this->render('@Communication/Default/consulerannonce.html.twig');
    }
}
