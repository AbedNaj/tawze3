<div>
    <form class="space-y-2" wire:submit.prevent="transfer" method="POST">
        <div class="max-w-2xl space-y-2 mx-auto">
            <x-select :label="__('inventory.employee')" :async-data="route('api.v1.employees')" option-label="name" option-value="id" wire:model.defer="employee"
                placeholder=" {{ __('common.select') }} " />

            <x-select :label="__('inventory.product_type')" :options="$productTypes" name="productType" wire:model.live="productType"
                option-label="name" option-value="id" placeholder=" {{ __('common.select') }} " />

            @if ($productType)
                <x-select name="product" :label="__('inventory.product')" :options="$products" option-label="name" option-value="id"
                    wire:model.live="product" placeholder=" {{ __('common.select') }} " />

                <p class="text-sm text-gray-500">
                    {{ $productCount ? __('inventory.remaining_amount') . ' : ' . $productCount : __('inventory.select_product') }}
                </p>
            @endif

            <x-input type="number" name="quantity" :label="__('inventory.restock_quantity')" wire:model.defer="quantity" min="0" />
        </div>

        <div class="flex items-center gap-4">
            <x-button primary type="submit" :label="__('inventory.transfer')" />

            <x-button flat type="button" @click="history.back()" :label="__('common.cancel')" />
        </div>
    </form>
</div>
