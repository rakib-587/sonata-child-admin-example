<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'product', cascade: ['persist', 'remove'])]
    private ?Inventory $inventory = null;

    public function __construct()
    {
        $this->createInventory();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getInventory(): ?Inventory
    {
        return $this->inventory;
    }

    public function setInventory(Inventory $inventory): static
    {
        // set the owning side of the relation if necessary
        if ($inventory->getProduct() !== $this) {
            $inventory->setProduct($this);
        }

        $this->inventory = $inventory;

        return $this;
    }

    public function createInventory(): void
    {
        if (null == $this->inventory) {
            $this->inventory = new Inventory($this);
        }
    }
}
