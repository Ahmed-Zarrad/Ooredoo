<?php

namespace App\Form;

use App\Entity\Cases;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;

class CasesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('CaseId')
            ->add('Title')
            ->add('Node')
            ->add('Severity')
            ->add('Status')
            ->add('start', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('end', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('background_color', ColorType::class)
            ->add('border_color', ColorType::class)
            ->add('text_color', ColorType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cases::class,
        ]);
    }
}
