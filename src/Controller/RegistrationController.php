<?php

namespace DelPlop\UserBundle\Controller;

use DelPlop\UserBundle\Entity\UserManagerInterface;
use DelPlop\UserBundle\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    /**
     * @var UserManagerInterface $userManager
     */
    private $userManager;

    public function __construct(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    public function register(Request $request, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $user = $this->userManager->createUser();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $passwordEncoder->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setRoles(['ROLE_USER']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('@DelPlopUser/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'activePage' => 'register'
        ]);
    }
}
