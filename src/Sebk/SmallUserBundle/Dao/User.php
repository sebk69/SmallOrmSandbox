<?php
/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

namespace Sebk\SmallUserBundle\Dao;

use Sebk\SmallOrmBundle\Dao\AbstractDao;

class User extends AbstractDao
{
    public function build()
    {
        $this->setDbTableName("user");
        $this->setModelName("User");
        $this->addPrimaryKey("id", "id");
        $this->addField("email", "email");
        $this->addField("password", "password");
        $this->addField("nickname", "nickname");
        $this->addField("salt", "salt");
        $this->addField("enabled", "enabled", false, static::TYPE_BOOLEAN);
        $this->addField("created_at", "createdAt", null, static::TYPE_DATETIME);
        $this->addField("updated_at", "updatedAt", null, static::TYPE_DATETIME);
    }
}