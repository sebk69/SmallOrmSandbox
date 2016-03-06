<?php

/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

namespace Sebk\ProjektorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sebk\SmallOrmBundle\Dao\ModelException;

/**
 * @route("/tasks")
 */
class TaskController extends Controller {

    /**
     * @Route("/{id}")
     * @method({"GET"})
     */
    public function getOne($id, Request $request) {
        $taskDao = $this->get("sebk_small_orm_dao")
                ->get("SebkProjektorBundle", "Task");
        
        $query = $taskDao->baseQuery();
        $query = $taskDao->findId($id, $query);
        
        return new Response(json_encode($taskDao->getResult($query)));
    }
    
    /**
     * @Route("")
     * @method({"GET"})
     */
    public function getAll(Request $request) {
        $taskDao = $this->get("sebk_small_orm_dao")
                ->get("SebkProjektorBundle", "Task");

        $query = $taskDao->digestGet($request->query->all());
        
        return new Response(json_encode($taskDao->getResult($query)));
    }
}
