<?php

namespace Sebk\SmallUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @route("")
 */
class UserController extends Controller
{
    /**
     * @route("/myself", options={"expose"=true})
     * @method({"GET"})
     */
    public function userAction()
    {
        
    }
}
