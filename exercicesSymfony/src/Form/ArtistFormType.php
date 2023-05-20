<?php

namespace App\Form;

use App\Entity\Artist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ArtistFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title')
        ->add('enabled')
        ->add('sex')
        ->add('sex', ChoiceType::class, [
            'choices' => [
                'F' => 'Femme',
                'M' => 'Homme',
            ],
            'expanded' => true,
        ])
        ->add('enabled', CheckboxType::class, [
            'label' => 'Completed',
            'required' => false,
        ])
        ->add('artist', EntityType::class, [
            'class' => Artist::class,
            'choice_label' => 'name'
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}
