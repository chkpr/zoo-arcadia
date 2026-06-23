<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Votre nom', 'row_attr' => ['class' => 'form-row-half'],])
            ->add('firstname', TextType::class, ['label' => 'Votre prénom', 'row_attr' => ['class' => 'form-row-half'],])
            ->add('email', TextType::class, ['label' => 'Votre adresse e-mail'])
            ->add('message', TextareaType::class, ['label' => 'Votre message'])
            ->add('save', SubmitType::class, ['label' => 'Envoi'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
