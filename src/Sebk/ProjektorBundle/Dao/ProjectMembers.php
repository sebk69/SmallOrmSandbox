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

    public function build() {
        $this->setDbTableName("project_members");
        $this->setModelName("ProjectMember");
        $this->addPrimaryKey("id", "id");
        $this->addField("id_project", "idProject");
        $this->addField("id_user", "idUser");
        $this->addField("id_project_role", "idProjectRole");
        $this->addToOne("project", array("idProject" => "id"), "Project");
        $this->addToOne("user", array("idUser" => "id"), "User", "SebkSmallUserBundle");
        $this->addToOne("role", array("idProjectRole" => "id"), "ProjectRole");
    }

}
