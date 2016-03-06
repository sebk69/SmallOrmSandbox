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

/**
 * @route("/projects")
 */
class ProjectController extends Controller {

    /**
     * @param Request $request
     * @return Response
     * @Route("/new")
     * @method({"GET"})
     */
    public function create(Request $request) {
        $projectDao = $this->get("sebk_small_orm_dao")
            ->get("SebkProjektorBundle", "Project");

        $project = $projectDao->newModel();

        return new Response(json_encode($project));
    }

    /**
     * @param $id
     * @param Request $request
     * @return Response
     * @Route("/{id}")
     * @method({"GET"})
     */
    public function getResource($id, Request $request) {
        $projectDao = $this->get("sebk_small_orm_dao")
                ->get("SebkProjektorBundle", "Project");
        
        $query = $projectDao->baseQuery();
        $query = $projectDao->findId($id, $query);

        return new Response(json_encode($projectDao->getResult($query)[0]));
    }
    
    /**
     * @param Request $request
     * @return Response
     * @Route("")
     * @method({"GET"})
     */
    public function query(Request $request) {
        $projectDao = $this->get("sebk_small_orm_dao")
                ->get("SebkProjektorBundle", "Project");

        return new Response(json_encode($projectDao->getResult($projectDao->baseQuery())));
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("")
     * @method({"POST"})
     */
    public function save(Request $request) {
        $data = json_decode($request->getContent());

        $projectDao = $this->get("sebk_small_orm_dao")
            ->get("SebkProjektorBundle", "Project");

        $project = $projectDao->makeModelFromStdClass($data);

        $validator = $this->get("sebk_small_orm_validator")->get($project);
        if(!$validator->validate()) {
            return new Response($validator->getMessage(), 400);
        }

        $projectDao->persist($project);

        return new Response(json_encode($project));
    }
}
