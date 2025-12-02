                     <x-admin.sale.card>
                         <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                             <i class="fas fa-info-circle mx-2 text-blue-600"></i>
                             {{ __('sale.sale.invoice_details') }}
                         </h3>
                         <div class="space-y-3">
                             <div class="flex justify-between">
                                 <span
                                     class="text-sm font-medium text-gray-600">{{ __('sale.sale.invoice_number') }}:</span>
                                 <span class="text-sm font-bold text-gray-800">#{{ $sale->invoice_number }}</span>
                             </div>
                             <div class="flex justify-between">
                                 <span
                                     class="text-sm font-medium text-gray-600">{{ __('sale.sale.invoice_date') }}:</span>
                                 <span class="text-sm text-gray-800">{{ $sale->created_at->format('Y-m-d') }}</span>
                             </div>

                             <div class="flex justify-between">
                                 <span
                                     class="text-sm font-medium text-gray-600">{{ __('sale.sale.created_by') }}:</span>
                                 <span class="text-sm text-gray-800">{{ $sale->user->name }}</span>
                             </div>

                         </div>
                     </x-admin.sale.card>
