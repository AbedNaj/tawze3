<?php

namespace App\Enums;

enum EmployeeInventoryStatusEnum: string
{

    case InStock = 'in_stock';
    case OutStock = 'out_stock';

    public function color(): string
    {
        return match ($this) {

            self::InStock => 'green',
            self::OutStock => 'red',
        };
    }
    public function label(): string
    {
        return match ($this) {
            self::InStock => __('employee.inventory.status.in_stock'),
            self::OutStock => __('employee.inventory.status.out_stock'),
        };
    }
}
