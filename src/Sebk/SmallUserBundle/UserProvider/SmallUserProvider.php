<?php

/**
 * This file is a part of SmallUserBundle
 * Distributed under GNU GPL V3 licence
 * © 2015 - Sébastien Kus
 */

namespace Sebk\SmallUserBundle\UserProvider;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Sebk\SmallOrmBundle\Dao\DaoException;

class SmallUserProvider implements UserProviderInterface
{
    protected $modelBundle;
    protected $modelClass;

    public function __construct($bundle, $class) {
        $this->modelBundle = $bundle;
        $this->modelClass = $class;
    }

    public function refreshUser(UserInterface $user)
    {
        $class = getClass($user);

        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException("Instance of '$class' not supported");
        }

        return $this->container
                ->get("sebk_smallorm_dao")
                ->get($this->modelBundle, $this->modelClass)
                ->findOneBy(array("id" => $user->getId())); // TODO add roles dependency
    }

    public function loadUserByUsername($username)
    {
        try {
            return $this->container
                ->get("sebk_smallorm_dao")
                ->get($this->getBundle(), $this->getModelName())
                ->findOneBy(array("email" => $username)); // TODO add roles dependency
        } catch (DaoException $e) {
            throw new UsernameNotFoundException("Email '$username' not found in database");
        }
    }

    public function supportsClass($class)
    {
        return $class === 'Sebk\SmallUserBundle\Model\User';
    }
}