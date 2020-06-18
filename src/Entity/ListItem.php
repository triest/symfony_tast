<?php

namespace App\Entity;

use App\Repository\ListItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListItemRepository::class)
 */
class ListItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $market;

    /**
     * @ORM\Column(name="created", type="string", length=255, nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(name="updeted", type="string", length=255, nullable=true)
     */
    private $updated;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMarket(): ?string
    {
        return $this->market;
    }

    public function setMarket(?string $market): self
    {
        $this->market = $market;

        return $this;
    }

    /**
     * @ORM\PrePersist
     *
     */
    public function doStuffOnPrePersist()
    {
        $this->created = date('Y-m-d H:i:s');
    }

    /**
     *  @ORM\PreUpdate
     */
    public function doStuffOnPreUpdate()
    {
        $this->updated = date('Y-m-d H:i:s');
    }
}
