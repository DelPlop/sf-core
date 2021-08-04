<?php

namespace DelPlop\UserBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface as BaseUserInterface;

interface UserInterface extends BaseUserInterface
{
    public function getId(): ?int;

    public function getLogin(): string;

    public function setLogin(string $login): self;

    public function getEmail(): string;

    public function setEmail(string $email): self;

//    public function getUserIdentifier(): string;

//    public function getUsername(): string;

//    public function getRoles(): array;

    public function setRoles(array $roles): self;

//    public function getPassword(): ?string;

    public function setPassword(string $password): self;

//    public function getSalt(): ?string;
//    public function eraseCredentials();
}
