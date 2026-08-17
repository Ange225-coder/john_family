<?php

    namespace App\Form\Fields\Member\RegisterAndAuth;

    use App\Entity\Member;
    use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
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
            pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{4,8}$/',
            message: 'Le mot de passe doit contenir entre 4 et 8 caractères, avec une majuscule, une minuscule et un chiffre.'
        )]
        private ?string $password = null;



        // Setters and Getters
        public function setPseudonyme(?string $pseudonyme): void
        {
            $this->pseudonyme = $pseudonyme;
        }

        public function setPassword(?string $password): void
        {
            $this->password = $password;
        }

        public function getPseudonyme(): ?string
        {
            return $this->pseudonyme;
        }

        public function getPassword(): ?string
        {
            return $this->password;
        }
    }
