<?php

    namespace App\Form\Fields\Member\Settings;

    use Symfony\Component\HttpFoundation\File\UploadedFile;
    use Symfony\Component\Validator\Constraints as Assert;

    class ProfilePictureFields
    {
        #[Assert\File(
            maxSize: '2M',
            mimeTypes: ['image/png', 'image/jpg', 'image/jpeg', 'image/webp'],
            maxSizeMessage: 'La taille de l\'image ne doit pas dépasser 2Mo',
            mimeTypesMessage: 'Les extensions recommandées sont : .png, .jpg, .jpeg, .webp'
        )]
        private ?UploadedFile $profilePicture = null;


        public function setProfilePicture(?UploadedFile $profilePicture): void
        {
            $this->profilePicture = $profilePicture;
        }

        public function getProfilePicture(): ?UploadedFile
        {
            return $this->profilePicture;
        }
    }
