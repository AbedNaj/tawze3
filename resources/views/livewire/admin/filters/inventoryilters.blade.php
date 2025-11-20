<div class="flex  max-w-xl space-x-2">
    <x-select :options="$inventoryStatusOption" option-label="label" option-value="id" wire:model.live="inventoryStatus"
        placeholder="{{ __('common.select') }}" label="{{ __('inventory.inventory_status') }}" />
    <x-input type="text" wire:model.live="productName" label="{{ __('product.name') }}" />


</div>
