<?php

    namespace App\Form\Fields\Member\RegisterAndAuth;

    use Symfony\Component\Validator\Constraints as Assert;

    class RegistrationStepOneFields
    {
        #[Assert\Regex(
            pattern: '/^[\p{L}]{2,15}$/u',
            message: 'Format incorrect - Votre nom doit être sous la forme Déli ou DELI - sans espace'
        )]
        private ?string $lastName = null;

        #[Assert\Regex(
            pattern: '/^(?=.{3,30}$)[\p{L}]+(?: [\p{L}]+)*$/u',
            message: 'Le prénom doit être compris entre 3 et 30 caractères'
        )]
        private ?string $firstName = null;


        // Setters and Getters
        public function setFirstName(?string $firstName): void
        {
            $this->firstName = $firstName;
        }

        public function setLastName(?string $lastName): void
        {
            $this->lastName = $lastName;
        }

        public function getFirstName(): ?string
        {
            return $this->firstName;
        }

        public function getLastName(): ?string
        {
            return $this->lastName;
        }
    }
