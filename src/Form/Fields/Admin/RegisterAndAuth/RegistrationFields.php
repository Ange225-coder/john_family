<?php

    namespace App\Form\Fields\Admin\RegisterAndAuth;

    use App\Entity\Admin;
    use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
    use Symfony\Component\Validator\Constraints as Assert;

    #[UniqueEntity('adminName', message: 'Ce nom semble être déjà utilisé', entityClass: Admin::class)]
    class RegistrationFields
    {
        #[Assert\Regex(
            pattern: '/^[a-zA-Z]{3,15}$/',
            message: 'Cette valeur doit contenir entre 3 et 15 lettres uniquement (sans accents ni caractères spéciaux).'
        )]
        private ?string $adminName = null;

        #[Assert\Regex(
            pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{4,32}$/',
            message: 'Le mot de passe doit contenir entre 4 et 32 caractères, avec une majuscule, une minuscule et un chiffre.'
        )]
        private ?string $password = null;


        // Setters ans Getters
        public function setPassword(?string $password): void
        {
            $this->password = $password;
        }

        public function setAdminName(?string $adminName): void
        {
            $this->adminName = $adminName;
        }

        public function getPassword(): ?string
        {
            return $this->password;
        }

        public function getAdminName(): ?string
        {
            return $this->adminName;
        }
    }
