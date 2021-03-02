<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Rollerworks\Component\PasswordStrength\Validator\Constraints\PasswordStrength;

class UserAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roles', ChoiceType::class, [
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'super admin' => 'ROLE_SUPER_ADMIN',
                    'admin' => 'ROLE_ADMIN',
                    'utilisateur' => 'ROLE_USER'
                ]
            ])

            ->add('civilite', ChoiceType::class, [
                'choices' => [
                    'Monsieur' => 'monsieur',
                    'Madame' => 'madame',
                ],
                'label' => 'Civilité'
            ])

            ->add('nom', TextType::class, [
                'attr' => [
                    'placeholder' => 'Dupont'
                ],
                'label' => 'Nom'
            ])

            ->add('prenom', TextType::class, [
                'attr' => [
                    'placeholder' => 'Jean'
                ],
                'label' => 'Prénom'
            ])

            ->add('phone', IntegerType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => '0123456789',
                    'max' => 999999999999
                ],
                'label' => 'Téléphone'
            ])

            ->add('email', EmailType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'prenom.nom@domaine.com'
                ]
            ])

            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'constraints' => [
                    new PasswordStrength([
                        'minLength' => 8,
                        'tooShortMessage' => 'Le mot de passe doit contenir au moins 8 caractères',
                        'minStrength' => 4,
                        'message' => 'Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial'
                        ])
                ],
                'attr' => [
                    'placeholder' => '••••••••'
                ],
                'label' => 'Mot de passe',
                'required' => false
            ])
                    
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}