<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Rollerworks\Component\PasswordStrength\Validator\Constraints\PasswordStrength;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
                'label' => 'Nom',
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/\d/',
                        'match' => false,
                        'message' => 'Votre nom ne peut pas contenir de nombre',
                    ])
                ]
            ])

            ->add('prenom', TextType::class, [
                'attr' => [
                    'placeholder' => 'Jean'
                ],
                'label' => 'Prénom',
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/\d/',
                        'match' => false,
                        'message' => 'Votre prénom ne peut pas contenir de nombre',
                    ])
                ]
            ])

            ->add('phone', TextType::class, [
                'attr' => [
                    'placeholder' => '0123456789'
                ],
                'label' => 'Téléphone'
            ])

            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'prenom.nom@domaine.com'
                ]
            ])

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de renseigner un mot de passe',
                    ]),
                    // new Length([
                    //     'min' => 6,
                    //     'minMessage' => 'Your password should be at least {{ limit }} characters',
                    //     // max length allowed by Symfony for security reasons
                    //     'max' => 4096,
                    // ]),
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
                'label' => 'Mot de passe'
            ])
            

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions générales d\utilisation',
                    ]),
                ],
                'label' => 'J\'accepte les conditions générales d\'utilisation'
            ])
            ->add('inscription', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
