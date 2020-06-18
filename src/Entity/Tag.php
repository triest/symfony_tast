<?php

    namespace App\Entity;

    use App\Repository\TagRepository;
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;
    use Symfony\Component\Validator\Mapping\ClassMetadata;

    /**
     * @ORM\Entity(repositoryClass=TagRepository::class)
     */
    class Tag
    {
        /**
         * @ORM\Id()
         * @ORM\GeneratedValue()
         * @ORM\Column(type="integer")
         */
        private $id;

        /**
         * @ORM\Column(type="string", length=255, nullable=false, unique=true)
         */
        private $name;

        /**
         * @ORM\ManyToMany(targetEntity="App\Entity\Article", mappedBy="tags")
         */
        private $articles;

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getName(): ?string
        {
            return $this->name;
        }

        public function setName(?string $name): self
        {
            $this->name = $name;

            return $this;
        }

        public static function loadValidatorMetadata(ClassMetadata $metadata)
        {
            $metadata->addPropertyConstraint('name', new Assert\Unique());
        }
    }
