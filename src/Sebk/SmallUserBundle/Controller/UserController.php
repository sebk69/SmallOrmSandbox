<?php

/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

namespace Sebk\SmallUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sebk\SmallOrmBundle\Dao\ModelException;

/**
 * @route("/")
 */
class UserController extends Controller {

    /**
     * @Route("/login_check")
     * @method({"POST"})
     */
    public function loginCheckAction() {
        
    }

    /**
     * @Route("/myself")
     * @method({"GET"})
     */
    public function getMyself(Request $request) {
        return new Response(json_encode($this->get('security.token_storage')->getToken()->getUser()), 200);
    }

    /**
     * @route("/myself")
     * @method({"PUT"})
     */
    public function putMyself(Request $request) {
        // create model object for new user
        $userStdClass = json_decode($request->getContent());

        $userDao = $this->get("sebk_small_orm_dao")
                ->get("SebkSmallUserBundle", "User");

        $newUser = $userDao->makeModelFromStdClass($userStdClass);

        // check password change
        $passwordToEncode = null;
        if ($newUser->getPassword() != "") {
            try {
            if ($newUser->getPassword() != $newUser->getPasswordConfirm()) {
                return new Response(json_encode("Password and confirmation don't mach"), 400);
            }

            $passwordToEncode = $newUser->getPassword();
            } catch(ModelException $e) {
                return new Response(json_encode("You must type password confirmation"), 400);
            }
        }

        $this->get("sebk_small_users_provider")->updateUser(
                $this->get('security.token_storage')->getToken()->getUser(), 
                $newUser->getEmail(), 
                $newUser->getNickname(), 
                $passwordToEncode
        );

        return new Response(json_encode($newUser), 200);
    }

}
