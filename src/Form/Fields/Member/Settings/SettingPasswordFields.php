<?php

    namespace App\Form\Fields\Member\Settings;

    use Symfony\Component\Validator\Constraints as Assert;

    class SettingPasswordFields
    {
        #[Assert\NotBlank()]
        private ?string $currentPassword = null;

        #[Assert\Regex(
            pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{4,32}$/',
            message: 'Le mot de passe doit contenir entre 4 et 32 caractères, avec une majuscule, une minuscule et un chiffre.'
        )]
        private ?string $newPassword = null;


        // Setters and Getters
        public function setCurrentPassword(?string $currentPassword): void
        {
            $this->currentPassword = $currentPassword;
        }

        public function setNewPassword(?string $newPassword): void
        {
            $this->newPassword = $newPassword;
        }

        public function getCurrentPassword(): ?string
        {
            return $this->currentPassword;
        }

        public function getNewPassword(): ?string
        {
            return $this->newPassword;
        }
    }
