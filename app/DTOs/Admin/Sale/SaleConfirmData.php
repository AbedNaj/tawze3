<?php

namespace App\DTOs\Admin\Sale;

use App\Models\Tenants\Sale;
use App\Models\Tenants\User;

class SaleConfirmData
{
    public function __construct(
        public Sale $sale,
        public array $saleItems,
        public float $salePrice,
        public float $paidAmount,
        public int $paymentMethodId,
        public User $performedBy,
    ) {}
}
