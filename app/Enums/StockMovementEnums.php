<?php

namespace App\Enums;

enum StockMovementEnums: string
{
    case purchase_in = 'purchase_in';
    case sale_out = 'sale_out';
    case return_in = 'return_in';
    case adjustment_in = 'adjustment_in';
    case adjustment_out = 'adjustment_out';
    case transfer_out = 'transfer_out';
    case transfer_in = 'transfer_in';
    case reserved = 'reserved';
    case reserved_release = 'reserved_release';
    case correction = 'correction';

    public function label(): string
    {

        return match ($this) {
            self::purchase_in => __('stockMovement.purchase_in'),
            self::sale_out => __('stockMovement.sale_out'),
            self::return_in => __('stockMovement.return_in'),
            self::adjustment_in => __('stockMovement.adjustment_in'),
            self::adjustment_out => __('stockMovement.adjustment_out'),
            self::transfer_out => __('stockMovement.transfer_out'),
            self::transfer_in => __('stockMovement.transfer_in'),
            self::reserved => __('stockMovement.reserved'),
            self::reserved_release => __('stockMovement.reserved_release'),
            self::correction => __('stockMovement.correction'),
        };
    }

    public function color(): string
    {
        return match ($this) {

            // IN
            self::purchase_in => 'green',
            self::return_in => 'green',
            self::adjustment_in => 'green',
            self::transfer_in => 'green',

            // OUT
            self::sale_out => 'red',
            self::adjustment_out => 'red',
            self::transfer_out => 'red',

            // RESERVED
            self::reserved => 'yellow',

            // RELEASE
            self::reserved_release => 'gray',

            // CORRECTION
            self::correction => 'gray-dark',
        };
    }
}
