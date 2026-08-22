<?php

    namespace App\Form\Types\Admin\RegisterAndAuth;

    use App\Form\Fields\Admin\RegisterAndAuth\RegistrationFields;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class RegistrationType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('adminName', TextType::class, [
                    'label' => 'Nom d\'administrateur'
                ])

                ->add('password', PasswordType::class, [
                    'label' => 'Mot de passe'
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => RegistrationFields::class
            ]);
        }
    }
