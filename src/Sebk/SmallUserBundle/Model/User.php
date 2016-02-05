<?php
/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

namespace Sebk\SmallUserBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Sebk\SmallOrmBundle\Dao\Model;

class User extends Model implements UserInterface, EquatableInterface
{
    public function beforeSave()
    {
        try {
            if (($encoder = $this->getEncoder()) && ($plainPassword = $this->getPasswordToEncode())) {
                $this->setPassword($encoder->encodePassword($plainPassword, $this->getSalt()));
            }
        } catch (\Exception $e) {
            $this->setPassword(Model::FIELD_NOT_PERIST);
            $this->setSalt(Model::FIELD_NOT_PERIST);
        }

        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime);
        }
        $this->setUpdatedAt(new \DateTime);
    }

    public function getRoles()
    {
        return array("ROLE_USER");
    }

    public function getUsername()
    {
        return $this->getEmail();
    }

    public function getPassword()
    {
        return parent::getPassword();
    }

    public function getSalt()
    {
        return parent::getSalt();
    }

    public function eraseCredentials()
    {
        $this->setPassword("");
        $this->setSalt("");
    }

    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof User) {
            return false;
        }

        if ($this->getPassword() != $user->getPassword()) {
            return false;
        }

        if ($this->getSalt() != $user->getSalt()) {
            return false;
        }

        if ($this->getUsername() != $user->getUsername()) {
            return false;
        }

        return true;
    }
}