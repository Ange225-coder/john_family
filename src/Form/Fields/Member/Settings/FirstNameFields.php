<?php

    namespace App\Form\Fields\Member\Settings;

    use Symfony\Component\Validator\Constraints as Assert;

    class FirstNameFields
    {
        #[Assert\NotBlank]
        private ?string $currentFirstName = null;

        #[Assert\Regex(
            pattern: '/^(?=.{3,30}$)[\p{L}]+(?: [\p{L}]+)*$/u',
            message: 'Le prénom doit être compris entre 3 et 30 caractères'
        )]
        private ?string $newFirstName = null;


        // Setters and Getters
        public function setCurrentFirstName(?string $currentFirstName): void
        {
            $this->currentFirstName = $currentFirstName;
        }

        public function setNewFirstName(?string $newFirstName): void
        {
            $this->newFirstName = $newFirstName;
        }


        public function getCurrentFirstName(): ?string
        {
            return $this->currentFirstName;
        }

        public function getNewFirstName(): ?string
        {
            return $this->newFirstName;
        }
    }
