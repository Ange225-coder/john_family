<?php

    namespace App\Form\Types\Member\Settings;

    use App\Form\Fields\Member\Settings\FirstNameFields;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class FirstNameType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('currentFirstName', TextType::class, [
                    'label' => 'Votre prénom actuel',
                    'attr' => [
                        'readonly' => true
                    ]
                ])

                ->add('newFirstName', TextType::class, [
                    'label' => 'Entrez un nouveau prénom'
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => FirstNameFields::class
            ]);
        }
    }
