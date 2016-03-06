<?php

/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

namespace Sebk\ProjektorBundle\Dao;

use Sebk\SmallOrmBundle\Dao\AbstractDao;
use Sebk\SmallOrmBundle\QueryBuilder\QueryBuilder;

class Task extends AbstractDao {

    /**
     * @throws \Sebk\SmallOrmBundle\Dao\DaoException
     */
    public function build() {
        $this->setDbTableName("task");
        $this->setModelName("Task");
        $this->addPrimaryKey("branch", "branch");
        $this->addField("label", "label");
        $this->addField("finished", "finished");
        $this->addField("developer_id", "developerId");
        $this->addField("user_id", "userId");
        $this->addToOne("project", array("projectId" => "id"), "Project");
        $this->addToOne("developer", array("developerId" => "id"), "User", "SmallUserBundle");
        $this->addToOne("user", array("userId" => "id"), "User", "SmallUserBundle");
    }

    /**
     * @param $get
     * @param QueryBuilder|null $query
     * @throws \Sebk\SmallOrmBundle\QueryBuilder\BracketException
     * @throws \Sebk\SmallOrmBundle\QueryBuilder\QueryBuilderException
     */
    public function digestGet($get, QueryBuilder $query = null) {
        if($query === null) {
            $query = $this->baseQuery();
        }

        foreach($get as $key => $param) {
            switch($key) {
                case "id":
                    $this->findForId($param);
                    break;

                case "label":
                    $query->getWhere()
                        ->andCondition($query->getFieldForCondition("label"), "LIKE", ":taskLabel");
                    $query->setParameter("taskLabel", "%".$param."%");
                    break;

                case "branch":
                    $query->getWhere()
                        ->andCondition($query->getFieldForCondition("branch"), "=", ":taskBranch");
                    $query->setParameter("taskBranch", $param);
                    break;

                case "myself":
                    $query->getWhere()
                        ->andBracket()
                            ->firstCondition($query->getFieldForCondition("project", "leaderId"), "=", $this->container->get('security.token_storage')->getToken()->getUser())
                            ->orCondition($query->getFieldForCondition("developerId"), "=", $this->container->get('security.token_storage')->getToken()->getUser())
                            ->orCondition($query->getFieldForCondition("userId"), "=", $this->container->get('security.token_storage')->getToken()->getUser());
                    break;

                case "projectId":
                    $query->getWhere()
                        ->andCondition($query->getFieldForCondition("projectId"), "=", ":taskProjectId");
                    $query->setParameter("taskProjectId", $param);
            }
        }
    }

    /**
     * @return QueryBuilder
     * @throws \Sebk\SmallOrmBundle\QueryBuilder\BracketException
     */
    public function baseQuery() {
        $query = $this->createQueryBuilder("task")
            ->innerJoin("task", "project")->endJoin()
            ->leftJoin("task", "developer")->endJoin()
            ->leftJoin("task", "user")->endJoin();
        ;

        $query->where()
            ->firstCondition(1, "=", 1)
        ;

        return $query;
    }

    /**
     * @param $id
     * @param QueryBuilder|null $query
     * @return QueryBuilder
     * @throws \Sebk\SmallOrmBundle\QueryBuilder\QueryBuilderException
     */
    public function findForId($id, QueryBuilder $query = null) {
        if($query === null) {
            $query = $this->baseQuery();
        }

        $query->getWhere()
            ->andCondition($query->getFieldForCondition("id"), "=", ":id");

        $query->setParameter("id", $id);

        return $query;
    }
}
