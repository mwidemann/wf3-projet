<?php

namespace App\Form;

use App\Entity\Livraison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LivraisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('denomination', TextType::class, [
                'label' => 'Adresse',
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
                ]
            ])
            ->add('addPrenom', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Ex.: Jean'
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
