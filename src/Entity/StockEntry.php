<?php

namespace App\Entity;

use App\Enum\StockEntryTypeEnum;
use App\Repository\StockEntryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockEntryRepository::class)]
class StockEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'stockEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Inventory $inventory = null;

    #[ORM\Column(length: 255)]
    private ?StockEntryTypeEnum $entryType = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?int $stock = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInventory(): ?Inventory
    {
        return $this->inventory;
    }

    public function setInventory(?Inventory $inventory): static
    {
        $this->inventory = $inventory;

        return $this;
    }

    public function getEntryType(): ?StockEntryTypeEnum
    {
        return $this->entryType;
    }

    public function setEntryType(StockEntryTypeEnum $entryType): static
    {
        $this->entryType = $entryType;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function calculateStock(): static
    {
        $previousStock = $this->inventory->getStock();

        if ($this->entryType->isPositive()) {
            $this->stock = $previousStock + $this->quantity;
        } else {
            $this->stock = $previousStock - $this->quantity;
        }

        return $this;
    }
}
