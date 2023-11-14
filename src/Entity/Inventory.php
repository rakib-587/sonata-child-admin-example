<?php

namespace App\Entity;

use App\Repository\InventoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InventoryRepository::class)]
class Inventory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'inventory', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\Column(options: ['default' => 0])]
    private ?int $stock = 0;

    #[ORM\OneToMany(mappedBy: 'inventory', targetEntity: StockEntry::class, orphanRemoval: true)]
    private Collection $stockEntries;

    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->stockEntries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Collection<int, StockEntry>
     */
    public function getStockEntries(): Collection
    {
        return $this->stockEntries;
    }

    public function addStockEntry(StockEntry $stockEntry): static
    {
        if (!$this->stockEntries->contains($stockEntry)) {
            $this->stockEntries->add($stockEntry);
            $stockEntry->calculateStock();
            $this->setStock($stockEntry->getStock());
        }

        return $this;
    }
}
