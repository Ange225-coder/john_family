<?php

    namespace App\Entity;

    use App\Repository\MemberRepository;
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
    use Symfony\Component\Security\Core\User\UserInterface;

    #[ORM\Entity(repositoryClass: MemberRepository::class)]
    #[ORM\Table(name: '`member`')]
    class Member implements UserInterface, PasswordAuthenticatedUserInterface
    {
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id = null;

        #[ORM\Column(length: 180, unique: true)]
        private ?string $pseudonyme = null;

        #[ORM\Column]
        private array $roles = [];

        #[ORM\Column]
        private ?string $password = null;

        #[ORM\Column(length: 128)]
        private ?string $lastName = null;

        #[ORM\Column(length: 128)]
        private ?string $firstName = null;

        #[ORM\Column(length: 255, nullable: true)]
        private ?string $profilePicture = null;

        #[ORM\Column]
        private ?\DateTimeImmutable $createdAt = null;



        // Setters and Getters
        public function getId(): ?int
        {
            return $this->id;
        }

        public function getPseudonyme(): ?string
        {
            return $this->pseudonyme;
        }

        public function setPseudonyme(string $pseudonyme): static
        {
            $this->pseudonyme = $pseudonyme;

            return $this;
        }

        /**
         * A visual identifier that represents this user.
         *
         * @see UserInterface
         */
        public function getUserIdentifier(): string
        {
            return (string) $this->pseudonyme;
        }

        /**
         * @see UserInterface
         */
        public function getRoles(): array
        {
            $roles = $this->roles;
            // guarantee every user at least has ROLE_MEMBER
            $roles[] = 'ROLE_MEMBER';

            return array_unique($roles);
        }

        /**
         * @param list<string> $roles
         */
        public function setRoles(array $roles): static
        {
            $this->roles = $roles;

            return $this;
        }

        /**
         * @see PasswordAuthenticatedUserInterface
         */
        public function getPassword(): ?string
        {
            return $this->password;
        }

        public function setPassword(string $password): static
        {
            $this->password = $password;

            return $this;
        }

        /**
         * Ensure the session doesn't contain actual password hashes by CRC32C-hashing them, as supported since Symfony 7.3.
         */
        public function __serialize(): array
        {
            $data = (array) $this;
            $data["\0".self::class."\0password"] = hash('crc32c', $this->password);

            return $data;
        }

        #[\Deprecated]
        public function eraseCredentials(): void
        {
            // @deprecated, to be removed when upgrading to Symfony 8
        }

        public function getLastName(): ?string
        {
            return $this->lastName;
        }

        public function setLastName(string $lastName): static
        {
            $this->lastName = $lastName;

            return $this;
        }

        public function getFirstName(): ?string
        {
            return $this->firstName;
        }

        public function setFirstName(string $firstName): static
        {
            $this->firstName = $firstName;

            return $this;
        }

        public function getProfilePicture(): ?string
        {
            return $this->profilePicture;
        }

        public function setProfilePicture(?string $profilePicture): static
        {
            $this->profilePicture = $profilePicture;

            return $this;
        }

        public function getCreatedAt(): ?\DateTimeImmutable
        {
            return $this->createdAt;
        }

        public function setCreatedAt(\DateTimeImmutable $createdAt): static
        {
            $this->createdAt = $createdAt;

            return $this;
        }
    }
