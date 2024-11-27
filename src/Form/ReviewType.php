<?php

namespace App\Form;

use App\Entity\Reviews;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('author')
            
            ->add('rate', ChoiceType::class, [
                'label' => 'Note',
                'choices' => [
                    '5' => '5',
                    '4' => '4',
                    '3' => '3',
                    '2' => '2',
                    '1' => '1',

                ],
                'attr' => [
                    'class' => 'rate',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('content')
            ->add('status', ChoiceType::class, [
                'label' => 'Souhaitez-vous envoyer cet avis ?',
                'choices' => [
                    'Confirmer l\'envoi' => false,
                   
                ],
             'expanded' => true,
                    'multiple' => false,
            
            ]);
            
         

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reviews::class,
        ]);
    }
}
