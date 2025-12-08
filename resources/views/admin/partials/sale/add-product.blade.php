  <x-button label="{{ __('product.add_new') }}" x-on:click="$openModal('addProductModal')" primary />

  <x-modal-card :title="__('sale.sale.add_product')" name="addProductModal">

      <form wire:submit.prevent='productItemCreate'>


          <x-select wire:model.live="selectedProductType" :label="__('sale.sale.product_type')" :options="$productTypes" option-label="name"
              option-value="id" />
          @if ($selectedProductType)

              <x-select wire:model.live="product" :placeholder="__('sale.sale.product_select')" :label="__('sale.sale.product')" :options="$products"
                  option-label="name" option-value="id" />

              @if ($productInventory >= 0 && $product)
                  <div class="mt-2 text-sm text-gray-500 flex items-center gap-2">
                      <span class="font-medium text-gray-700">
                          {{ $isForEmployee ? __('sale.sale.available_employee_quantity') . ' ' . $employeeName : __('sale.sale.available__quantity') }}:
                      </span>
                      <span class="bg-gray-100 text-gray-800 px-2 py-0.5 rounded-md">
                          {{ $productInventory }}
                      </span>
                  </div>
              @endif

              <x-input wire:model='quantity' type="number" :label="__('sale.sale.quantity')"></x-input>
          @endif

          <div class="mt-2">

              <x-button wire:click='cancelItemCreate' flat :label="__('common.cancel')" x-on:click="close" />

              <x-button primary type="submit" :label="__('common.add')" />
          </div>


      </form>

  </x-modal-card>
