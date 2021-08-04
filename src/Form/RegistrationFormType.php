<?php

namespace DelPlop\UserBundle\Form;

use DelPlop\UserBundle\Entity\UserInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login')
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'form.errors.password_not_blank',
                        ]),
                        new Length([
                            'min' => 8,
                            'minMessage' => 'form.errors.password_min_length',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    'label' => 'form.login.password',
                ],
                'second_options' => [
                    'label' => 'form.login.password_confirm',
                ],
                'invalid_message' => 'form.errors.passwords_must_match',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'first_options' => [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'form.errors.email_not_blank',
                        ]),
                    ],
                    'label' => 'form.login.email'
                ],
                'second_options' => [
                    'label' => 'form.login.password_confirm',
                ],
                'invalid_message' => 'form.errors.emails_must_match',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserInterface::class,
        ]);
    }
}
