<?php

    namespace App\Form\Fields\Member\RegisterAndAuth;

    class RegistrationFields
    {
        private ?string $lastName = null;
        private ?string $firstName = null;
        private ?string $pseudonyme = null;

        // Setters and Getters
        public function setFirstName(?string $firstName): void
        {
            $this->firstName = $firstName;
        }

        public function setLastName(?string $lastName): void
        {
            $this->lastName = $lastName;
        }

        public function setPseudonyme(?string $pseudonyme): void
        {
            $this->pseudonyme = $pseudonyme;
        }
    }
