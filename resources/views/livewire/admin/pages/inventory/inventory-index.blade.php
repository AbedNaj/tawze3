 <div class="mb-8">

     <section class="space-y-2 mb-4">
         <div class="max-w-lg">

             <x-select :options="$locationTypes" wire:model.live='selectedLocationType' option-label="label" option-value="id"
                 :placeholder="__('common.select')" :label="__('inventory.inventory_location')"></x-select>
         </div>

         @if ($selectedLocationType)
             <div wire:key="location-select-{{ $selectedLocationType }}" class="max-w-lg">
                 <x-select wire:model.live='selectedLocationable' :options="$locationItems" option-label="name" option-value="id"
                     :placeholder="__('common.select')" :label="__('inventory.inventory_location')"></x-select>
             </div>
         @endif


     </section>
     @if ($selectedLocationable)
         <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">

             {{ __('product.inventory_list') }}
         </h3>
         <div class="flex my-2  max-w-xl space-x-2">
             <x-select :options="$inventoryStatusOption" option-label="label" option-value="id" wire:model.live="inventoryStatus"
                 placeholder="{{ __('common.select') }}" label="{{ __('inventory.inventory_status') }}" />
             <x-input type="text" wire:model.live.debounce.500ms="productName" label="{{ __('product.name') }}" />


         </div>
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
                                         size="md" :title="__('inventory.restock_product')" :buttonLabel="__('inventory.restock')">


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
     @else
         <div class="mt-6 p-12 text-center bg-white rounded-2xl shadow-xl border border-slate-200/50">
             <div class="flex flex-col items-center space-y-4">
                 <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center">
                     <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                         </path>
                     </svg>
                 </div>
                 <div class="text-center">
                     <h3 class="text-lg font-medium text-slate-600">{{ __('inventory.select_location') }}</h3>
                     <p class="text-slate-500 mt-1">{{ __('inventory.select_location_sub_message') }}</p>
                 </div>
             </div>
         </div>
     @endif

 </div>
