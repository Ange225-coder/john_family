<?php

    namespace App\Form\Fields\Member\RegisterAndAuth;

    use App\Entity\Member;
    use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
    use Symfony\Component\HttpFoundation\File\UploadedFile;
    use Symfony\Component\Validator\Constraints as Assert;

    #[UniqueEntity('pseudonyme', message: 'Ce pseudonyme semble être déjà utilisé', entityClass: Member::class)]
    class RegistrationStepTwoFields
    {
        #[Assert\Regex(
            pattern: '/^[a-zA-Z0-9_.-]{3,20}$/',
            message: 'Le pseudo peut être sous la forme deli2.0 ("-_." sont autorisés).'
        )]
        private ?string $pseudonyme = null;

        #[Assert\Regex(
            pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{4,32}$/',
            message: 'Le mot de passe doit contenir entre 4 et 32 caractères, avec une majuscule, une minuscule et un chiffre.'
        )]
        private ?string $password = null;

        #[Assert\File(
            maxSize: '2M',
            mimeTypes: ['image/png', 'image/jpg', 'image/jpeg', 'image/webp'],
            maxSizeMessage: 'La taille de l\'image ne doit pas dépasser 2Mo',
            mimeTypesMessage: 'Les extensions recommandées sont : .png, .jpg, .jpeg, .webp'
        )]
        private ?UploadedFile $profilePicture = null;



        // Setters and Getters
        public function setPseudonyme(?string $pseudonyme): void
        {
            $this->pseudonyme = $pseudonyme;
        }

        public function setPassword(?string $password): void
        {
            $this->password = $password;
        }

        public function setProfilePicture(?UploadedFile $profilePicture): void
        {
            $this->profilePicture = $profilePicture;
        }

        public function getPseudonyme(): ?string
        {
            return $this->pseudonyme;
        }

        public function getPassword(): ?string
        {
            return $this->password;
        }

        public function getProfilePicture(): ?UploadedFile
        {
            return $this->profilePicture;
        }
    }
