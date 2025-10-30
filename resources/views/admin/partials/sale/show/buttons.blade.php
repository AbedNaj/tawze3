                      <div>
                          <a href="{{ route('admin.sales.index') }}"
                              class="px-6 py-3 bg-gradient-to-r hover:cursor-pointer from-blue-500 to-blue-500 text-white rounded-lg hover:from-blue-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 font-medium">
                              <i class="fas fa-arrow-left  mx-2"></i>{{ __('sale.sale.back_to_sales') }}
                          </a>
                      </div>
                      @if ($sale->status == App\Enums\SaleStatusEnum::CONFIRMED->value)
                          <div class="space-x-4">
                              <button wire:click='saleCancel'
                                  class="px-6 py-3 border border-gray-300 hover:cursor-pointer text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                                  <i class="fas fa-trash mx-2"></i>{{ __('sale.sale.cancel_sale') }}
                              </button>
                              <button wire:click='saleDelete'
                                  class="px-6 py-3 bg-blue-600 hover:cursor-pointer text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                                  <i class="fas fa-print mr-2"></i>
                                  {{ __('sale.sale.print_invoice') }}
                              </button>
                          </div>
                      @endif
