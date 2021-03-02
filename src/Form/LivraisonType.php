<?php

namespace App\Form;

use App\Entity\Livraison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;

class LivraisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('denomination', TextType::class, [
                'label' => 'Nom de l\'adresse',
                'attr' => [
                    'placeholder' => 'Ex.: Chez moi' 
                ]
            ])
            ->add('addCivilite', ChoiceType::class, [
                'label' => 'Civilité',
                'choices' => [
                    'Monsieur' => 'monsieur',
                    'Madame' => 'madame',
                ]
            ])
            ->add('addNom', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Ex.: Dupont'
                ],
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/\d/',
                        'match' => false,
                        'message' => 'Votre nom ne peut pas contenir de nombre',
                    ])
                ]
            ])
            ->add('addPrenom', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Ex.: Jean'
                ],
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/\d/',
                        'match' => false,
                        'message' => 'Votre prénom ne peut pas contenir de nombre',
                    ])
                ]
            ])
            ->add('adresse', TextType::class , [
                'label' => 'Adresse',
                'attr' => [
                    'placeholder' => 'Ex.: 10 rue du Village'
                ]
            ])
            ->add('complement', TextType::class , [
                'label' => 'Complément',
                'required' => false,
                'attr' => [
                    'placeholder' => 'batiment, étage, digicode, ...'
                ]
            ])
            ->add('cp', IntegerType::class, [
                'label' => 'Code postal',
                'attr' => [
                    'placeholder' => 'Ex.: 67100'
                ]
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Ex.: Strasbourg'
                ]
            ])
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livraison::class,
        ]);
    }
}
