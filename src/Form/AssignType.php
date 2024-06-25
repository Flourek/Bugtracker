<?php
/**
 * EPI License.
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form to assign users to bugs on the main page.
 */
class AssignType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder builder
     * @param array                $options options
     *
     * @return void void
     *              builds the form for assigning users to bugs
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('bugs', CollectionType::class, ['entry_type' => SubmitType::class])
            ->add('save', SubmitType::class, ['attr' => ['class' => 'save']]);
    }

    /**
     * @param OptionsResolver $resolver resolver
     *
     * @return void void
     *
     * the options of the form
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => null,
            ]
        );
    }
}
