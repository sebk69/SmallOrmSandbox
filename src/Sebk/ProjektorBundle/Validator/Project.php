<?php
/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

namespace Sebk\ProjektorBundle\Validator;

use Sebk\SmallOrmBundle\Validator\AbstractValidator;
use Sebk\SmallOrmBundle\Dao\ModelException;

class Project extends AbstractValidator
{

    /**
     * @return boolean
     */
    public function validate()
    {
        $message = "";
        $result  = true;

        if(!$this->testNonEmpty("name")) {
            $message .= "The name of project is mandatory\n";
            $result = false;
        }

        if(!$this->testUnique("name")) {
            $message .= "The name of project has already been used\n";
            $result = false;
        }

        if(!$this->testNonEmpty("branchPrefix")) {
            $message .= "The branch prefix is mandatory\n";
            $result = false;
        }

        if(!$this->testNonEmpty("leaderId")) {
            $message .= "You must choose a project leader\n";
            $result = false;
        }

        $this->message = $message;

        return $result;
    }
}