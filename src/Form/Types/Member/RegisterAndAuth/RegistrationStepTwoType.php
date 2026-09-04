<?php

    namespace App\Form\Types\Member\RegisterAndAuth;

    use App\Form\Fields\Member\RegisterAndAuth\RegistrationStepTwoFields;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\FileType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class RegistrationStepTwoType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('pseudonyme', TextType::class, [
                    'label' => 'Pseudonyme',
                    'attr' => [
                        'placeholder' => 'Ex. : emma_225'
                    ]
                ])

                ->add('password', PasswordType::class, [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' => 'Ex. : 4 caractères minimum'
                    ]
                ])

                ->add('profilePicture', FileType::class, [
                    'label' => 'Photo de profil',
                    'required' => false,
                    'attr' => [
                        'accept' => '.png, .jpg, .jpeg, .webp'
                    ]
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => RegistrationStepTwoFields::class
            ]);
        }
    }
