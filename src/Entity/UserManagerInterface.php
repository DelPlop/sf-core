<?php

namespace DelPlop\UserBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

interface UserManagerInterface
{
    public function createUser(): UserInterface;

    public function getClass(): string;

    public function findUserBy(array $criteria): UserInterface;
}