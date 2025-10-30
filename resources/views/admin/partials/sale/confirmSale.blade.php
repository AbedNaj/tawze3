           <x-admin.dialog :title="__('sale.sale.confirm_sale')" show="confirmSale">

               <x-admin.sale.select name="selectedProductType" :label="__('sale.sale.product_type_select')"
                   :options="$productTypes">{{ __('sale.sale.product_type') }}</x-admin.sale.select>

               @if ($selectedProductType)
                   <x-admin.sale.select name="product" :label="__('sale.sale.product_select')"
                       :options="$products">{{ __('sale.sale.product') }}</x-admin.sale.select>
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
                   <x-admin.sale.input name="quantity" type="number" :label="__('sale.sale.quantity')"></x-admin.sale.input>

               @endif

               <div class="mt-2">

                   <x-admin.buttons.cancel wireClick="cancelItemCreate"
                       click="addProduct = false"></x-admin.buttons.cancel>
                   <x-admin.form.button>{{ __('sale.sale.product_add') }}</x-admin.form.button>
               </div>
               </form>
           </x-admin.dialog>
