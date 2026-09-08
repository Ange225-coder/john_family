<?php

    namespace App\Form\Types\Member\Settings;

    use App\Form\Fields\Member\Settings\ProfilePictureFields;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\FileType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class ProfilePictureType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder->add('profilePicture', FileType::class, [
                'attr' => [
                    'accept' => '.png, .jpg, .jpeg, .webp'
                ]
            ]);
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => ProfilePictureFields::class
            ]);
        }
    }
