<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\User;
use App\Entity\car;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CarContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('phoneNumber')
            ->add('content')
            ->add('carName', HiddenType::class, ['data' => $options['car_name']])
            ->add('carPrice', HiddenType::class, ['data' => $options['car_price']])
            ->add('carId', HiddenType::class, ['data' => $options['car_id']])
            ->add('Envoyer', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'car_name' => null,
            'car_price' => null,
            'car_id' => null,
        ]);
    }
}
