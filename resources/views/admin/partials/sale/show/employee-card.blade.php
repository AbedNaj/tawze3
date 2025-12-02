          <x-admin.sale.card>
              <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                  <i class="fas fa-user-tie mx-2 text-green-600"></i>
                  {{ __('sale.sale.employee') }}
              </h3>
              <div class="space-y-3">
                  @if ($sale->employee)
                      <div class="flex items-center">
                          <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                              <i class="fas fa-user text-white text-sm"></i>
                          </div>
                          <div>
                              <p class="font-medium text-gray-800">{{ $sale->employee->name }}</p>
                              <p class="text-sm text-gray-600">{{ $sale->employee->email }}</p>
                          </div>
                      </div>
                  @else
                      <div class="text-center py-4">
                          <i class="fas fa-user-slash text-gray-400 text-2xl mb-2"></i>
                          <p class="text-sm text-gray-500">{{ __('sale.sale.no_employee_assigned') }}</p>
                      </div>
                  @endif
              </div>
          </x-admin.sale.card>
