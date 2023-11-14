<?php

namespace App\EntityListener;

use App\Entity\StockEntry;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, entity: StockEntry::class)]
class StockEntryEntityListener
{
    public function prePersist(StockEntry $stockEntry, PrePersistEventArgs $event)
    {
        $stockEntry->getInventory()->addStockEntry($stockEntry);
    }
}
