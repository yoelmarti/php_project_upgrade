<?php

namespace App\Form;

use App\Entity\EntradaCine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntradaCineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombrePelicula')
            ->add('fechaInicio', DateTimeType::class)
            ->add('fechaFin', DateTimeType::class)
            ->add('numEntradas')
            ->add('bolsaPalomitas')
            // ->add('Usuario')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EntradaCine::class,
        ]);
    }
}
