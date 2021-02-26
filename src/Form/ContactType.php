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
                'required' => true
            ])
            ->add('nom', TextType::class, [
                'required' => true
            ])
            ->add('email', EmailType::class, [
                'required' => true
            ])
            ->add('objet', ChoiceType::class, [
                'required' => true,
                'choices' => [ 
                    ' - Choix - ' => '',
                    'Signaler un problème' => 'probleme',
                    'Postuler' => 'emploi',
                    'Poser une question' => 'question'
                ]
            ])
            ->add('message', TextareaType::class, [
                'required' => true,
                'attr' => [
                    'minlength' => 50,
                    'maxlength' => 500
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
