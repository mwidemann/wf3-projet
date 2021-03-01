<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', TextType::class, [
                'required' => true,
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Ex : Ken'
                ]
            ])
            ->add('nom', TextType::class, [
                'required' => true,
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Ex : Lesurvivant'
                ]
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Adresse e-mail',
                'attr' => [
                    'placeholder' => 'Ex : noken@hokuto.fr'
                ]
            ])
            ->add('objet', ChoiceType::class, [
                'required' => true,
                'label' => 'Objet',
                'choices' => [ 
                    ' - Choix - ' => '',
                    'Signaler un problème' => 'probleme',
                    'Postuler' => 'emploi',
                    'Poser une question' => 'question'
                ]
            ])
            ->add('message', TextareaType::class, [
                'required' => true,
                'label' => 'Message',
                'attr' => [
                    'minlength' => 20,
                    'maxlength' => 500,
                    'placeholder' => 'Saisir le message...'
                ],
                'help' => 'Maximum 500 caractères'
            ])
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
