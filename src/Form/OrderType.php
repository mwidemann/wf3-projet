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
            ])
            ->add('moyenPaiement', ChoiceType::class, [
                'label' => 'Moyen de paiement',
                'choices' => [
                    'Espèces' => 'especes',
                    'Carte' => 'carte',
                    'Tickets restaurant' => 'tickets_restaurant',
                ]
            ])
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
