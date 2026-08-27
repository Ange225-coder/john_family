<?php

    namespace App\Form\Fields\Member\Settings;

    use Symfony\Component\Validator\Constraints as Assert;

    class LastNameFields
    {
        #[Assert\NotBlank(message: 'Cette valeur ne doit pas être vide')]
        private ?string $currentLastName = null;

        #[Assert\Regex(
            pattern: '/^[\p{L}]{2,15}$/u',
            message: 'Format incorrect - Votre nom doit être sous la forme Déli ou DELI - sans espace'
        )]
        private ?string $newLastName = null;


        // Setters and Getters
        public function setCurrentLastName(?string $currentLastName): void
        {
            $this->currentLastName = $currentLastName;
        }

        public function setNewLastName(?string $newLastName): void
        {
            $this->newLastName = $newLastName;
        }

        public function getCurrentLastName(): ?string
        {
            return $this->currentLastName;
        }

        public function getNewLastName(): ?string
        {
            return $this->newLastName;
        }
    }
