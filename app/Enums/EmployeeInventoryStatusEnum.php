<?php

namespace App\Enums;

enum EmployeeInventoryStatusEnum: string
{
    case Normal = 'normal';
    case LowStock = 'low_stock';
    case OutOfStock = 'out_of_stock';

    public function color(): string
    {
        return match ($this) {
            self::Normal => 'green',
            self::LowStock => 'yellow',
            self::OutOfStock => 'red',
        };
    }
    public function label(): string
    {
        return match ($this) {
            self::Normal => __('employee.inventory.status.normal'),
            self::LowStock => __('employee.inventory.status.low_stock'),
            self::OutOfStock => __('employee.inventory.status.out_of_stock'),
        };
    }
}
