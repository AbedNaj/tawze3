 <div class="mb-8">
     <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">

         {{ __('product.inventory_list') }}
     </h3>

     <div class="overflow-x-auto bg-white rounded-lg border border-gray-200 shadow-sm ">

         <div class="md:hidden space-y-4 p-4">
             @forelse ($inventories as $index => $item)
                 <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                     <div class="flex justify-between items-start mb-3">
                         <div class="flex-1">
                             <h3 class="font-medium text-gray-900 text-right">
                             </h3>
                             <span class="text-sm text-gray-500">#{{ $index + 1 }}</span>
                         </div>
                     </div>
                     <div class="grid grid-cols-3 gap-4">


                         <div>
                             <label
                                 class="block text-xs font-medium text-gray-500 mb-1">{{ __('product.name') }}</label>
                             <div class="text-sm font-medium">{{ $item->product->name }}</div>
                         </div>

                         <div>
                             <label
                                 class="block text-xs font-medium text-gray-500 mb-1">{{ __('product.quantity') }}</label>
                             <div class="text-sm font-medium">{{ $item->quantity }}</div>
                         </div>

                         <div>
                             <label
                                 class="block text-xs font-medium text-gray-500 mb-1">{{ __('product.min_stock_alert') }}</label>
                             <div class="text-sm font-medium">{{ $item->min_stock_alert }}</div>
                         </div>

                         <div>
                             <label
                                 class="block text-xs font-medium text-gray-500 mb-1">{{ __('product.last_restock_date') }}</label>
                             <div class="text-sm font-medium">{{ $item->last_restock_date }}</div>
                         </div>
                         @php
                             $inventoryStauts = App\Enums\InventoryStatusEnum::tryFrom($item->status);

                         @endphp
                         <div>
                             <label
                                 class="block text-xs font-medium text-gray-500 mb-1">{{ __('sale.sale.status') }}</label>
                             <div class="text-sm font-medium text-{{ $inventoryStauts->color() }}-600">
                                 {{ $inventoryStauts->label() }}</div>
                         </div>
                     </div>
                 </div>
             @empty
                 <x-common.no-data />
             @endforelse
         </div>

         <div class="hidden md:block overflow-x-auto">
             <table class="w-full min-w-full border-collapse">
                 <thead class="bg-gradient-to-l from-gray-50 to-gray-100">
                     <tr>
                         <th
                             class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                             #
                         </th>

                         <th
                             class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                             {{ __('product.name') }}
                         </th>



                         <th
                             class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                             {{ __('product.quantity') }}
                         </th>

                         <th
                             class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                             {{ __('product.min_stock_alert') }}
                         </th>

                         <th
                             class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                             {{ __('product.last_restock_date') }}
                         </th>

                         <th
                             class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                             {{ __('sale.sale.status') }}
                         </th>
                         <th
                             class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                             {{ __('common.actions') }}
                         </th>
                     </tr>
                 </thead>

                 <tbody class="bg-white divide-y divide-gray-100">
                     @forelse ($inventories as $index => $item)
                         @php

                             $inventoryStatus = App\Enums\InventoryStatusEnum::tryFrom($item->status);
                         @endphp

                         <tr class="hover:bg-gray-50 transition-colors">
                             <td class="px-4 py-4 text-sm text-gray-900 text-right">
                                 {{ $index + 1 }}
                             </td>
                             <td class="px-4 py-4 text-sm text-gray-900 text-right">
                                 {{ $item->product->name }}
                             </td>

                             <td class="px-4 py-4 text-sm text-gray-900 text-right">
                                 {{ $item->quantity }}
                             </td>

                             <td class="px-4 py-4 text-sm text-gray-900 text-right">
                                 {{ $item->min_stock_alert }}
                             </td>

                             <td class="px-4 py-4 text-sm text-gray-900 text-right">
                                 {{ $item->last_restock_date ?? '-' }}
                             </td>

                             <td class="px-4 py-4 text-sm">
                                 <span
                                     class="inline-flex items-center px-3 py-1.5
                                   bg-{{ $inventoryStatus?->color() ?? 'gray' }}-100
                                   text-{{ $inventoryStatus?->color() ?? 'gray' }}-800
                                   text-xs font-medium rounded-full shadow-sm">
                                     {{ $inventoryStatus?->label() ?? __('common.unknown') }}
                                 </span>
                             </td>
                             <td class="px-4 py-4 text-sm text-gray-900 text-right">

                                 <x-common.modal name="restockModel-{{ $item->id }}"
                                     saveWireClick="inventoryRestock('{{ $item->id }}')" :saveLabel="__('inventory.restock')"
                                     size="sm" :title="__('inventory.restock_product')" :buttonLabel="__('inventory.restock')">


                                     <div>
                                         <div>
                                             <x-input wire:model.live='quantity'
                                                 description="{{ __('inventory.current_quantity') . ' : ' . $item->quantity }}"
                                                 :label="__('inventory.restock_quantity')" />
                                         </div>

                                     </div>

                                 </x-common.modal>
                             </td>
                         </tr>
                     @empty
                         <x-common.no-data />
                     @endforelse
                 </tbody>
             </table>
         </div>


     </div>
 </div>
