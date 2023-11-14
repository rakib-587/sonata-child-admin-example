<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Product;
use App\Entity\StockEntry;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class StockEntryAdminController extends CRUDController
{
    protected function preCreate(Request $request, object $object): ?Response
    {
        /** @var StockEntry $object */

        /** @var Product */
        $product = $this->admin->getParent()->getSubject();
        $inventory = $product->getInventory();
        $object->setInventory($inventory);
        
        return null;
    }
}
