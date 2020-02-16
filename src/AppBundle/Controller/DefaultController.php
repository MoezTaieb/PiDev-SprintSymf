<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/front", name="homepagefront")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('Default/index.html.twig');

    }
    /**
     * @Route("/back", name="homepageback")
     */
    public function indexbackAction()
    {
        // replace this example code with whatever you need
        return $this->render('Default/indexback.html.twig');

    }




}
