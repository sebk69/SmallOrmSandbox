<?php

namespace Sebk\SmallUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SebkSmallUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
