<?php

    namespace App\Form\Types\Member\Settings;

    use App\Form\Fields\Member\Settings\LastNameFields;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class LastNameType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('currentLastName', TextType::class, [
                    'label' => 'Votre nom de famille actuel',
                    'attr' => [
                        'readonly' => true
                    ]
                ])

                ->add('newLastName', TextType::class, [
                    'label' => 'Entrez un nouveau nom'
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => LastNameFields::class
            ]);
        }
    }
