<?php

namespace App\Enum;

enum StockEntryTypeEnum: string
{
    case ADD = 'add';
    case RESTOCK = 'restock';
    case SELL = 'sell';

    public function isPositive(): bool
    {
        return match ($this) {
            self::ADD, self::RESTOCK => true,
            self::SELL => false,
        };
    }
}
