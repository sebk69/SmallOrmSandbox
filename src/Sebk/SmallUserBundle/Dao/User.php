<?php
/**
 * This file is a part of SmallUserBundle
 * Distributed under GNU GPL V3 licence
 * © 2015 - Sébastien Kus
 */

namespace Sebk\SmallUserBundle\Dao;

use \Sebk\SmallOrmBundle\Dao\AbstractDao;

class User extends AbstractDao
{

    public function build()
    {
        $this->setDbTableName("user")
            ->setModelName("User")
            ->addPrimaryKey("id", "id")
            ->addField("email", "email")
            ->addField("password", "password")
            ->addField("nickname", "nickname")
            ->addField("salt", "salt")
            ->addField("enabled", "enabled", true, "boolean")
            ->addField("created_at", "createdAt", null, "datetime")
            ->addField("updated_at", "updatedAt", null, "datetime")
        ;
    }
    
}