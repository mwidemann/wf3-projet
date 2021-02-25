<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('artNom', TextType::class, [
                'required' => true,
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Ex.: Sushis saumon'
                ]
            ])
            ->add('descri', TextType::class, [
                'required' => true,
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Ex.: Sushis saumon'
                ]
            ])
            ->add('photo', FileType::class, [
                'help' => 'png, jpg ou jpeg - 1 Mo maximum',
                'required' => true,
                'mapped' => false,
                'label' => 'Photo',
            ])
            ->add('prix', MoneyType::class, [
                'required' => true,
                'label' => 'Prix (€)',
                'attr' => [
                    'placeholder' => 'Ex.: 3.90',
                    'min' => 0
                ]
            ])
            ->add('cat1', ChoiceType::class, [
                'required' => true,
                'label' => 'Catégorie 1',
                'choices' => [
                    'Sushis' => 'sushis',
                    'Makis' => 'makis',
                    'Yakitori' => 'yakitori',
                    'Menu' => 'menu',
                ]
            ])
            ->add('cat2', ChoiceType::class, [
                'required' => false,
                'label' => 'Catégorie 2',
                'choices' => [
                    'Sushis' => 'sushis',
                    'Makis' => 'makis',
                    'Yakitori' => 'yakitori',
                    'Menu' => 'menu',
                ]
            ])
            ->add('cat3', ChoiceType::class, [
                'required' => false,
                'label' => 'Catégorie 3',
                'choices' => [
                    'Sushis' => 'sushis',
                    'Makis' => 'makis',
                    'Yakitori' => 'yakitori',
                    'Menu' => 'menu',
                ]
            ])
            ->add('top', ChoiceType::class, [
                'choices' => [
                    'Oui' => 1,
                    'Non' => 0,
                ],
                'label' => 'Mise en avant ?',
            ])
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
