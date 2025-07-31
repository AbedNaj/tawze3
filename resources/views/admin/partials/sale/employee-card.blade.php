           <x-admin.sale.card>

               @if (!$saleItems)
                   <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                       <i class="fas fa-user-tie mr-2 text-green-600"></i>{{ __('sale.sale.employee') }}
                   </h3>
                   <div class="space-y-3">
                       <div class="flex items-center mb-3">
                           <input wire:model.live='isForEmployee' type="checkbox" id="forEmployee"
                               class="mr-2 text-green-600 focus:ring-green-500" x-model="isForEmployee">
                           <label for="forEmployee" class="text-sm font-medium text-gray-700">
                               {{ __('sale.sale.invoice_for_employee') }}
                           </label>
                       </div>
                       <div x-show="isForEmployee" x-cloak x-transition>
                           <x-admin.sale.select name="employee" :options="$employees"
                               :label="__('sale.sale.select_emplyee')"></x-admin.sale.select>
                       </div>
                       <div x-show="!isForEmployee" x-transition>
                           <p class="text-sm text-gray-500 italic">
                               {{ __('sale.sale.not_for_specific_employee') }}
                           </p>
                       </div>
                   </div>
               @else
                   @if ($employee)
                       <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                           <i class="fas fa-user-tie mr-2 text-green-600"></i>{{ __('sale.sale.employee') }}
                       </h3>
                       <div class="space-y-3">
                           <p class="text-sm text-gray-700">
                               {{ __('sale.sale.selected_employee') }}: {{ $employeeName }}
                           </p>
                           <p class="text-sm text-gray-500 italic">
                               {{ __('sale.sale.employee_invoice_note') }}
                           </p>
                       </div>
                   @else
                       <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                           <i class="fas fa-user-tie mr-2 text-red-600"></i>{{ __('sale.sale.no_employee_selected') }}
                       </h3>
                   @endif
                   <div class="space-y-3">
                       <p class="text-xs text-gray-500">{{ __('sale.sale.remove_products_for_change_employee') }}
                       </p>
                   </div>
               @endif
           </x-admin.sale.card>
