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
                    'Plats' => 'plats',
                    'Menus' => 'menus',
                    'Accompagnements' => 'accompagnements',
                    'Boissons' => 'boissons',
                    'Desserts' => 'desserts',
                ]
            ])
            ->add('cat2', ChoiceType::class, [
                'required' => true,
                'label' => 'Catégorie 2',
                'choices' => [
                    'Riz' => 'riz', /* accompagnements */
                    'Soupes' => 'soupes', /* accompagnements */
                    'Nouilles' => 'nouilles', /* accompagnements */
                    'Gyozas' => 'gyozas', /* accompagnements */
                    'Salades' => 'salades', /* accompagnements */
                    'Brochettes' => 'brochettes', /* plats */
                    'Sushis' => 'sushis', /* plats */
                    'Makis' => 'makis', /* plats */
                    'Sashimis' => 'sashimis', /* plats */
                    'Tempuras' => 'tempuras', /* plats */
                    'Vins' => 'vins', /* boissons */
                    'Bières' => 'bières', /* boissons */
                    'Soft drinks' => 'soft drinks', /* boissons */
                    'Desserts' => 'desserts',                   
                    'Menus midi' => 'menu midi', /*Menus*/
                    'Menus brochettes' => 'menus brochettes', /*Menus*/
                    'Menus mixtes' => 'menus mixtes', /*Menus*/
                    'Menus sushi' => 'menus sushi', /*Menus*/
                    'Menus chirashi' => 'menus chirashi', /*Menus*/
                    'Menus bateaux' => 'menus bateaux', /*Menus*/
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
