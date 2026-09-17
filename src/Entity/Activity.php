<?php

    namespace App\Entity;

    use App\Repository\ActivityRepository;
    use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity(repositoryClass: ActivityRepository::class)]
    class Activity
    {
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id = null;

        #[ORM\Column(length: 128)]
        private ?string $type = null;

        #[ORM\Column(length: 255)]
        private ?string $title = null;

        #[ORM\Column]
        private ?\DateTimeImmutable $createdAt = null;



        // Setters and Getters
        public function getId(): ?int
        {
            return $this->id;
        }

        public function getType(): ?string
        {
            return $this->type;
        }

        public function setType(string $type): static
        {
            $this->type = $type;

            return $this;
        }

        public function getTitle(): ?string
        {
            return $this->title;
        }

        public function setTitle(string $title): static
        {
            $this->title = $title;

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
