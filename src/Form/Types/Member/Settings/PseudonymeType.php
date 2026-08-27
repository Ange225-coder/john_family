<?php

    namespace App\Form\Types\Member\Settings;

    use App\Form\Fields\Member\Settings\PseudonymeFields;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class PseudonymeType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('currentPseudonyme', TextType::class, [
                    'label' => 'Votre pseudonyme actuel',
                    'attr' => [
                        'readonly' => true
                    ]
                ])

                ->add('newPseudonyme', TextType::class, [
                    'label' => 'Entrez votre nouveau pseudonyme'
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => PseudonymeFields::class
            ]);
        }
    }
