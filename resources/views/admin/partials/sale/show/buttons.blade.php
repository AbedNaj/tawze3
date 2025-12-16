                      <div>
                          <a href="{{ route('admin.sales.index') }}"
                              class="px-6 py-3 bg-gradient-to-r hover:cursor-pointer from-blue-500 to-blue-500 text-white rounded-lg hover:from-blue-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 font-medium">
                              <i class="fas fa-arrow-left  mx-2"></i>{{ __('sale.sale.back_to_sales') }}
                          </a>
                      </div>

                      @if ($sale->status == App\Enums\SaleStatusEnum::CONFIRMED->value)
                          <div class="space-x-4">
                              <x-common.modal icon="trash" :title="__('sale.sale.cancel_sale')" saveWireClick="saleCancel"
                                  :buttonLabel="__('sale.sale.cancel_sale')">

                                  <p
                                      class="text-sm text-red-500 leading-relaxed bg-red-50 dark:bg-red-900/20 p-3 rounded-md border border-red-200 dark:border-red-700">
                                      {{ __('sale.sale.cancel_warning') }}
                                  </p>
                              </x-common.modal>


                              <x-button lg icon="printer" target="_blank" :label="__('sale.sale.print_invoice')" :href="route('admin.sales.print', 6)">


                              </x-button>
                          </div>
                      @endif
