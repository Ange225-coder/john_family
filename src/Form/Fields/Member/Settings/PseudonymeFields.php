<?php

    namespace App\Form\Fields\Member\Settings;

    use Symfony\Component\Validator\Constraints as Assert;

    class PseudonymeFields
    {
        #[Assert\NotBlank]
        private ?string $currentPseudonyme = null;

        #[Assert\Regex(
            pattern: '/^[a-zA-Z0-9_.-]{3,20}$/',
            message: 'Le pseudo peut être sous la forme deli2.0 ("-_." sont autorisés).'
        )]
        private ?string $newPseudonyme = null;


        // Setters and Getters
        public function setCurrentPseudonyme(?string $currentPseudonyme): void
        {
            $this->currentPseudonyme = $currentPseudonyme;
        }

        public function setNewPseudonyme(?string $newPseudonyme): void
        {
            $this->newPseudonyme = $newPseudonyme;
        }


        public function getCurrentPseudonyme(): ?string
        {
            return $this->currentPseudonyme;
        }

        public function getNewPseudonyme(): ?string
        {
            return $this->newPseudonyme;
        }
    }
