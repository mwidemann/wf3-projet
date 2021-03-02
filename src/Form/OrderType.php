<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateLivraison', DateTimeType::class, [
                'date_label' => 'Date et heure de livraison',
                // Pour limiter les champs disponibles (je triche un peu, ce sera à revoir)
                'years' => [2021],
                'months' => [3],
                'days' => [3, 4, 5, 6, 7, 8, 9],
                'hours' => [11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22],
                'minutes' => [0, 15, 30, 45]
            ])
            ->add('moyenPaiement', ChoiceType::class, [
                'label' => 'Moyen de paiement',
                'choices' => [
                    'Espèces' => 'especes',
                    'Carte' => 'carte',
                    'Tickets restaurant' => 'tickets_restaurant',
                ]
            ])
            ->add('valider', SubmitType::class, [
                'label' => 'Valider ma commande'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
