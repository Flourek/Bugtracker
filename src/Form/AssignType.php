<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Entity\User;

class AssignType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('bugs', CollectionType::class, [
                // each entry in the array will be an "email" field
                'entry_type' => SubmitType::class,
                // these options are passed to each "email" type
                'entry_options' => [
                    // 'attr' => ['class' => 'email-box'],
                ],
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
