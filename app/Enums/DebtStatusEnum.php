<?php

namespace App\Enums;

enum DebtStatusEnum: string
{
    case Paid = 'paid';
    case Unpaid = 'unpaid';
    case PartiallyPaid = 'partially_paid';

    public function label(): string
    {

        return match ($this) {
            self::Paid => __('sale.sale.paid'),
            self::Unpaid => __('sale.sale.unpaid'),
            self::PartiallyPaid => __('sale.sale.partially_paid'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PartiallyPaid => 'yellow',
            self::Paid => 'green',
            self::Unpaid => 'red',
        };
    }
}
