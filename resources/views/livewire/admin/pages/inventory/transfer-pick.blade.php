<div>
    <form class="space-y-2" wire:submit.prevent='transfer' method="POST">


        <div class="max-w-2xl space-y-2 mx-auto">
            <x-admin.form.select wireModel="employee" :label="__('inventory.employee')" :options="$employees"></x-admin.form.select>
            <x-admin.form.select wireModel="ProductType" :label="__('inventory.product_type')" :options="$productTypes"></x-admin.form.select>
            @if ($ProductType)
                <x-admin.form.select wireModel="product" :label="__('inventory.product')" :options="$products"></x-admin.form.select>

                <p class="text-sm text-gray-500">
                    {{ $productCount ? __('inventory.remaining_amount') . ' : ' . $productCount : __('inventory.select_product') }}
                </p>
            @endif
            <x-admin.form.input name="quantity" type="number" :label="__('inventory.restock_quantity')"></x-admin.form.select>
        </div>






        <div class="flex items-center gap-4">

            <x-admin.form.button>{{ __('inventory.transfer') }}</x-admin.form.button>

            <x-admin.buttons.cancel click="history.back()"></x-admin.buttons.cancel>


        </div>
    </form>
</div>
