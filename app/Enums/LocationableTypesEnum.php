<?php

namespace App\Enums;

enum LocationableTypesEnum: string
{
    case warehouse = 'warehouse';
    case employee = 'employee';



    public function label(): string
    {

        return match ($this) {
            self::warehouse => __('inventory.locationable.warehouse'),
            self::employee => __('inventory.locationable.employee'),
        };
    }
    public function modelClass(): string
    {
        return match ($this) {
            self::warehouse => \App\Models\Tenants\WareHouse::class,
            self::employee  => \App\Models\Tenants\Employee::class,
        };
    }
}
