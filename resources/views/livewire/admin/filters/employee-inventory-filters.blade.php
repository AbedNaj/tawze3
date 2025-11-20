<div class="flex max-w-lg space-x-2 ">
    <x-select :options="$employees" option-label="name" option-value="id" wire:model.live="saleStatus"
        placeholder="{{ __('employee.select') }}" label="{{ __('employee.name') }}" />
</div>
