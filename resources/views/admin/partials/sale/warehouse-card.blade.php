<x-admin.sale.card>
    @if (!$saleItems)
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-warehouse text-green-600"></i>
            {{ __('sale.sale.storage_location') }}
        </h3>

        <div class="my-2">
            <x-select wire:model.live="wareHouse" :options="$wareHouses" :label="__('sale.sale.warehouse')" :placeholder="__('sale.sale.select_warehouse')"
                option-label="name" option-value="id" />
        </div>

        <p class="text-sm text-gray-500 italic">
            {{ __('sale.sale.warehouse_invoice_note') }}
        </p>
    @else
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-warehouse text-green-600"></i>
            {{ __('sale.sale.warehouse') }}
        </h3>

        <div class="space-y-3">
            <p class="text-sm text-gray-700">
                {{ __('sale.sale.selected_warehouse') }}: {{ $warehouseName }}
            </p>
            <p class="text-xs text-gray-500">
                {{ __('sale.sale.remove_products_for_change_warehouse') }}
            </p>
        </div>
    @endif
</x-admin.sale.card>
