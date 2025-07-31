<?php

namespace App\Enums;

enum SaleStatusEnum: string
{
    case DRAFT = 'draft';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';

    public function label(): string
    {

        return match ($this) {
            self::DRAFT => __('sale.sale.draft'),
            self::CONFIRMED => __('sale.sale.confirmed'),
            self::CANCELLED => __('sale.sale.cancelled'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::DRAFT => 'yellow',
            self::CONFIRMED => 'green',
            self::CANCELLED => 'red',
        };
    }
}
