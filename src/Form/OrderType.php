<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start', DateType::class, [
                'required' => true,
                'label'=>'Początek rezerwacji',
                'format' => 'dd-MM-yyyy',
            ])
            ->add('finish', DateType::class, [
                'label'=>'Koniec rezerwacji',
                'required' => true,
                'format' => 'dd-MM-yyyy'
            ])
            ->add('reservedSlots', IntegerType::class, [
                'required' => true,
                'label' => "Ile chcesz zarezerwowac slotów",
                'constraints' => [
                    new NotBlank,
                    new LessThanOrEqual(
                        '8'
                    )
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
