<?php

namespace Sebk\ProjektorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SebkProjektorBundle:Default:index.html.twig', array('name' => $name));
    }
}
