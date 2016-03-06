<?php

/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

namespace Sebk\ProjektorBundle\Dao;

use Sebk\SmallOrmBundle\Dao\AbstractDao;
use Sebk\SmallOrmBundle\QueryBuilder\QueryBuilder;

class ProjectRole extends AbstractDao {

    public function build() {
        $this->setDbTableName("project_role");
        $this->setModelName("ProjectRole");
        $this->addPrimaryKey("id", "id");
        $this->addField("role", "role");
    }
}
