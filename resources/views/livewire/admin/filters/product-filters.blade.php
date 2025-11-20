<div class="flex max-w-md gap-2">
    <x-select :options="$productTypes" option-label="name" option-value="id" wire:model.live="productType"
        placeholder="{{ __('common.select') }}" label="{{ __('product.product_type') }}" />

</div>
