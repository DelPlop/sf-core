<?php

namespace DelPlop\UserBundle\Controller;

use App\Entity\ApplicationUser;
use DelPlop\UserBundle\Form\RegistrationFormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordEncoder,
        MailerInterface $mailer,
        TranslatorInterface $translator
    ): Response
    {
        $user = new ApplicationUser();
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

            // send welcome mail
            $email = (new TemplatedEmail())
                ->from(new Address($this->getParameter('mailer.sender_email'), $this->getParameter('mailer.sender_name')))
                ->to($user->getEmail())
                ->subject($translator->trans('registration.mail_object', [], 'messages'))
                ->htmlTemplate('@DelPlopUser/registration/email.html.twig')
                ->context([
                    'login' => $user->getLogin(),
                    'siteName' => $this->getParameter('site.name'),
                    'siteUrl' => $this->getParameter('site.url'),
                ])
            ;
            $mailer->send($email);

            return $this->redirectToRoute('login');
        }

        return $this->render('@DelPlopUser/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'activePage' => 'register'
        ]);
    }
}
