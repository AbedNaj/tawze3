<div class="flex  max-w-xl space-x-2">
    <x-input type="text" wire:model.live="customerName" label="{{ __('sale.sale.customer_name') }}" />
    <x-input type="text" wire:model.live="employeeName" label="{{ __('sale.sale.employee') }}" />
    <x-select :options="$saleStatusOptions" option-label="label" option-value="id" wire:model.live="saleStatus"
        placeholder="{{ __('common.select') }}" label="{{ __('sale.sale.status') }}" />
</div>
