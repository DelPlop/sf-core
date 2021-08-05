<?php

namespace DelPlop\UserBundle\Entity;

//use Symfony\Component\Security\Core\User\UserInterface;
use DelPlop\UserBundle\Repository\UserRepository;

class UserManager implements UserManagerInterface
{
    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(): UserInterface
    {
        $class = $this->getClass();
        $user = new $class();

        return $user;
    }

    public function getClass(): string
    {
        return RegisteredUser::class;
    }

    public function findUserBy(array $criteria): UserInterface
    {
        return $this->userRepository->findBy($criteria);
    }
}
