<?php

namespace App\Form;

use App\Entity\Reviews;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('author', TextType::class, ['label' => 'Votre prénom ou pseudo'])
            
            -> add('rate', HiddenType::class, [
                'label' => false,
                'attr' => ['id' => 'rate-value']
            ])

            ->add('content',TextType::class, ['label' => 'Votre avis'])
            
           ->add('status', ChoiceType::class, [
                'label' => 'Souhaitez-vous envoyer cet avis ?',
                'choices' => [
                    'Confirmer l\'envoi' => false,
                    ],
                'expanded' => true,
                'multiple' => false,
                ])
            ->add('save', SubmitType::class, ['label' => 'Envoi']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reviews::class,
        ]);
    }
}
