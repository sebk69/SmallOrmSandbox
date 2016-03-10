<?php

/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

namespace Sebk\ProjektorBundle\Dao;

use Sebk\SmallOrmBundle\Dao\AbstractDao;
use Sebk\SmallOrmBundle\QueryBuilder\QueryBuilder;

class Project extends AbstractDao {

    /**
     * @throws \Sebk\SmallOrmBundle\Dao\DaoException
     */
    public function build() {
        $this->setDbTableName("project");
        $this->setModelName("Project");
        $this->addPrimaryKey("id", "id");
        $this->addField("name", "name");
        $this->addField("branch_prefix", "branchPrefix");
        $this->addField("leader_user_id", "leaderId");
    }

    /**
     * @return QueryBuilder
     * @throws \Sebk\SmallOrmBundle\QueryBuilder\BracketException
     */
    public function baseQuery() {
        $query = $this->createQueryBuilder("project")
                        ->innerJoin("project", "leader")->endJoin()
        ;

        $query->where()
                ->firstCondition(1, "=", 1)
        ;

        return $query;
    }

    public function digestGet($get, QueryBuilder $query = null) {
        if($query === null) {
            $query = $this->baseQuery();
        }

        foreach($get as $key => $param) {
            switch($key) {
                case "id":
                    $query->getWhere()
                        ->andCondition($query->getFieldForCondition("id"), "=", ":id");
                    $query->setParameter("id", $param);
                    break;

                case "projectLeaderId":
                    $query->getWhere()
                        ->andCondition($query->getFieldForCondition("leaderId"), "=", ":leaderId");
                    if($param == "myself") {
                        $param = $this->container->get('security.token_storage')->getToken()->getUser()->getId();
                    }
                    $query->setParameter("leaderId", $param);
                    break;
            }
        }
    }

    /**
     * @param $leaderUserId
     * @param QueryBuilder|null $query
     * @return QueryBuilder
     * @throws \Sebk\SmallOrmBundle\QueryBuilder\QueryBuilderException
     */
    public function findForLeader($leaderUserId, QueryBuilder $query = null) {
        if($query === null) {
            $query = $this->baseQuery();
        }
        
        $query->getWhere()
                ->andCondition($query->getFieldForCondition("leaderId"), "=", ":leaderUserId");
        
        $query->setParameter("leaderUserId", $leaderUserId);
        
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
